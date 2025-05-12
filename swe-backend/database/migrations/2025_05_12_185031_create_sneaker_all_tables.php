<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sneaker_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sneaker_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sneaker_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        Schema::create('sneaker_product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_product_id')->constrained('sneaker_products')->onDelete('cascade');
            $table->string('url');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        Schema::create('sneaker_product_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_product_id')->constrained('sneaker_products')->onDelete('cascade');
            $table->foreignId('sneaker_category_id')->constrained('sneaker_categories')->onDelete('cascade');
        });

        Schema::create('sneaker_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_user_id')->nullable()->constrained('sneaker_users')->onDelete('cascade');
            $table->string('session_token')->nullable();
            $table->timestamps();
        });

        Schema::create('sneaker_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_cart_id')->constrained('sneaker_carts')->onDelete('cascade');
            $table->foreignId('sneaker_product_id')->constrained('sneaker_products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        Schema::create('sneaker_order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sneaker_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_user_id')->nullable()->constrained('sneaker_users')->onDelete('set null');
            $table->foreignId('sneaker_order_status_id')->default(1)->constrained('sneaker_order_statuses');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });

        Schema::create('sneaker_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_order_id')->constrained('sneaker_orders')->onDelete('cascade');
            $table->foreignId('sneaker_product_id')->constrained('sneaker_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('sneaker_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sneaker_user_id')->constrained('sneaker_users')->onDelete('cascade');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('postal_code');
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sneaker_addresses');
        Schema::dropIfExists('sneaker_order_items');
        Schema::dropIfExists('sneaker_orders');
        Schema::dropIfExists('sneaker_order_statuses');
        Schema::dropIfExists('sneaker_cart_items');
        Schema::dropIfExists('sneaker_carts');
        Schema::dropIfExists('sneaker_product_category');
        Schema::dropIfExists('sneaker_product_images');
        Schema::dropIfExists('sneaker_products');
        Schema::dropIfExists('sneaker_categories');
        Schema::dropIfExists('sneaker_users');
    }
};
