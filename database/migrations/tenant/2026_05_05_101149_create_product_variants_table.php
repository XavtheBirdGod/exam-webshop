<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->string('type');  // maat
            $table->string('value'); // xl/ m blabla

            // prijsaanpassing (bijv. +2.00 voor grotere maat)
            $table->decimal('additional_price', 8, 2)->default(0);

            $table->integer('stock')->default(0); // Voorraad per specifieke variant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
