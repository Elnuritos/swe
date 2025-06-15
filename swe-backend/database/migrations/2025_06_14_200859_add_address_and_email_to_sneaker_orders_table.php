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

        Schema::table('sneaker_orders', function (Blueprint $t) {
            $t->foreignId('sneaker_address_id')
                ->nullable()
                ->constrained('sneaker_addresses')
                ->nullOnDelete();
            $t->string('payment_email');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sneaker_orders', function (Blueprint $table) {
            //
        });
    }
};
