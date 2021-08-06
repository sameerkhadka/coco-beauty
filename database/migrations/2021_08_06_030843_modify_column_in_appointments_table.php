<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnInAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->nullable()->change();
            $table->text('phone')->nullable()->change();
            $table->text('technician_name')->nullable()->change();
            $table->text('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->change();
            $table->text('phone')->change();
            $table->text('technician_name')->change();
            $table->text('name')->change();
        });
    }
}
