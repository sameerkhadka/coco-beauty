<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_vouchers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('gift_for')->constrained('members')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->unsignedFloat('amount')->nullable();
            $table->date('issue_date')->nullable()->default(null);
            $table->date('expiry_date')->nullable()->default(null);
            $table->date('used_date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_vouchers');
    }
}
