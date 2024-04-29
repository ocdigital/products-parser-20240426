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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('code');
            $table->enum('status', ['published', 'draft', 'trash'])->default('draft');
            $table->timestamp('imported_t');
            $table->string('url',1000);
            $table->string('creator');
            $table->timestamp('created_t');
            $table->timestamp('last_modified_t');
            $table->string('product_name');
            $table->string('quantity');
            $table->string('brands');
            $table->string('categories',1000);
            $table->string('labels');
            $table->string('cities')->nullable();
            $table->string('purchase_places');
            $table->string('stores');
            $table->text('ingredients_text');
            $table->string('traces');
            $table->string('serving_size');
            $table->decimal('serving_quantity', 8, 2);
            $table->integer('nutriscore_score');
            $table->string('nutriscore_grade');
            $table->string('main_category');
            $table->string('image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
