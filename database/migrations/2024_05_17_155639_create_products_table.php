<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->string('product_code')->unique();
            $table->string('product_name')->unique();
            $table->string('product_brand')->nullable();
            $table->decimal('buying_price', 15, 2);
            $table->decimal('selling_price', 15, 2);
            $table->integer('discount')->default(0);
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('category_id')
                ->on('product_category')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('products');
    }
}
