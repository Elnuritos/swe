<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('sneaker_products')
        ->orderBy('id')
        ->chunkById(100, function ($products) {
            foreach ($products as $p) {
                if ($p->size && ! str_starts_with($p->size, '[')) {
                    DB::table('sneaker_products')
                        ->where('id', $p->id)
                        ->update([
                            'size' => json_encode([$p->size]),
                        ]);
                }
            }
        });

    // 2) Change column type to JSON
    Schema::table('sneaker_products', function (Blueprint $table) {
        $table->json('size')->nullable()->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
