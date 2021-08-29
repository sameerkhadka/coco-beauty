<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('member_id')->nullable()->constrained('members')->onDelete('cascade')->onUpdate('cascade');
            $table->text('full_name')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->mediumText('promotion')->nullable();
            $table->mediumText('gift_voucher')->nullable();
            $table->unsignedFloat('manual_discount')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('bandi_colour_gel')->nullable();
            $table->mediumText('opi_gel_and_normal')->nullable();
            $table->string('payment_method')->nullable();
            $table->longText('cart')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
