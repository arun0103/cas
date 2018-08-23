<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave', function (Blueprint $table) {

            $table->timestamps();

            $table->string('leave_id')->primary();
            $table->string('name');
            $table->float('max_leave_allowed');
            $table->float('min_leave_allowed');

            $table->boolean('weekly_off_cover'); // yes =1 , no =0 
            $table->boolean('paid_holiday_cover');

            $table->string('club_with_leaves');
            $table->string('cant_club_with_leaves');

            $table->string('balance_adjusted_from');
            $table->boolean('treat_present');
            $table->boolean('treat_absent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave');
    }
}
