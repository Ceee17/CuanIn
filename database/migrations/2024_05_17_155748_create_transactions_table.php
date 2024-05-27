<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        // Schema::create('transactions', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users');
        //     $table->foreignId('product_id')->constrained('products');
        //     $table->integer('quantity');
        //     $table->decimal('total_price', 10, 2);
        //     $table->timestamp('transaction_date');
        //     $table->timestamps();
        // });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
