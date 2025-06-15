<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderInvoiceMail;
use App\Models\Sneaker\SneakerUser;
use App\Models\Sneaker\SneakerProduct;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed necessary data for foreign keys
        DB::table('sneaker_order_statuses')->insert([
            ['id' => 1, 'name' => 'pending',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'confirmed', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'cancelled', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_checkout()
    {
        $payload = [
            'country'     => 'USA',
            'city'        => 'NY',
            'street'      => '1 Main St',
            'postal_code' => '10001',
            'phone'       => '+1000000000',
        ];

        $this->postJson('/api/orders/checkout', $payload)
             ->assertStatus(401);
    }

    /** @test */
    public function checkout_requires_address_and_payment_email()
    {
        /** @var \App\Models\Sneaker\SneakerUser $user */
        $user = SneakerUser::factory()->createOne();

        $this->actingAs($user, 'sanctum')
             ->postJson('/api/orders/checkout', [])
             ->assertStatus(422)
             ->assertJsonValidationErrors([
                 'country', 'city', 'street', 'postal_code', 'payment_email'
             ]);
    }

    /** @test */
    public function successful_checkout_creates_order_sends_email_and_clears_cart()
    {
        Mail::fake();

        /** @var \App\Models\Sneaker\SneakerUser $user */
        $user = SneakerUser::factory()->createOne();


        /** @var \App\Models\Sneaker\SneakerProduct $product */
        $product = SneakerProduct::create([
            'name'        => 'Test Sneaker',
            'description' => 'Test desc',
            'price'       => 50.00,
            'color'       => 'black',
            'size'        => ['42'],
            'stock'       => 10,
        ]);


        $this->actingAs($user, 'sanctum')
             ->postJson('/api/cart', [
                 'product_id' => $product->id,
                 'quantity'   => 2,
                 'size'       => ['42'],
             ])->assertStatus(201);

        $payload = [
            'country'       => 'USA',
            'city'          => 'NY',
            'street'        => '1 Main St',
            'postal_code'   => '10001',
            'phone'         => '+1000000000',
            'payment_email' => $user->email,
        ];

        $this->actingAs($user, 'sanctum')
             ->postJson('/api/orders/checkout', $payload)
             ->assertStatus(201)
             ->assertJsonPath('total', '100.00');

        $this->assertDatabaseHas('sneaker_orders', [
            'sneaker_user_id' => $user->id,
            'total'           => 100.00,
        ]);

        Mail::assertSent(OrderInvoiceMail::class);


        $this->assertDatabaseCount('sneaker_cart_items', 0);
    }
}
