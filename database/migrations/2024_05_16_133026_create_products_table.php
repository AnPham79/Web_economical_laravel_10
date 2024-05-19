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
            $table->id();
            $table->string('product_name')->unique();
            $table->string('product_slug_name')->unique();
            $table->string('product_short_description')->nullable();
            $table->text('product_description')->nullable();
            $table->decimal('product_regular_price');
            $table->decimal('product_percent_sale')->nullable();
            // SKU gọi là mã hàng hóa
            $table->string('product_SKU')->nullable();
            // tình trạng tồn kho
            $table->enum('stock_status', ['in_stock', 'out_of_stock'])->default('in_stock');
            $table->unsignedInteger('product_quantity')->default(10);
            $table->string('product_image')->nullable();
            $table->text('product_images')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
