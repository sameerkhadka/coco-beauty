<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailPhoneColumnInGiftVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_vouchers', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->text('phone')->nullable();
            $table->dropColumn('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gift_vouchers', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->date('expiry_date')->nullable();
        });
    }
}
