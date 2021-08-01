<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthdayDiscountUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthday_discount_usages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('cascade')->onUpdate('cascade');
            $table->date('used_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('birthday_discount_usages');
    }
}
