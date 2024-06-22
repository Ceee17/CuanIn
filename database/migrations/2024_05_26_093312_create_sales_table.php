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
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('sales_id');
            $table->integer('member_id')->nullable();
            $table->integer('total_item');
            $table->decimal('total_price', 10, 2);
            $table->tinyInteger('discount')->default(0);
            $table->decimal('payment', 10, 2)->default(0);
            $table->integer('received')->default(0);
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
