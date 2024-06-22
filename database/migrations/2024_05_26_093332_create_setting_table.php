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
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->string('company_name');
            $table->text('address')->nullable();
            $table->string('phone_number');
            $table->tinyInteger('note_type');
            $table->smallInteger('discount')->default(0);
            $table->string('logo_path');
            $table->string('card_member_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
