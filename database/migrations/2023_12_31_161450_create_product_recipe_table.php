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
      
            Schema::create('product_recipe', function (Blueprint $table) {
                $table->unsignedBigInteger('recipe_id');
                $table->unsignedBigInteger('product_id');
                $table->decimal('quantity', 8, 2);
                $table->primary(['recipe_id', 'product_id']);
                $table->foreign('recipe_id')->references('id')->on('recipes');
                $table->foreign('product_id')->references('id')->on('products');
            });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_product');
    }
};
