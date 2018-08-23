<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualPunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_punches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('emp_id');
            $table->string('dept_id');
            $table->string('company_id');
            $table->string('category_id'); 

            $table->date('punch_date');
            $table->string('punch_1',5)->nullable();  // punch time to be recorded
            $table->string('punch_2',5)->nullable();
            $table->string('punch_3',5)->nullable();
            $table->string('punch_4',5)->nullable();
            $table->string('punch_5',5)->nullable();
            $table->string('punch_6',5)->nullable();

            $table->boolean('day_status1'); // next day = 1, same day = 0
            $table->boolean('day_status2');
            $table->boolean('day_status3');
            $table->boolean('day_status4');
            $table->boolean('day_status5');
            $table->boolean('day_status6');

            $table->integer('early_in')->nullable();
            $table->integer('early_out')->nullable();
            $table->integer('late_in')->nullable();
            $table->integer('overstay')->nullable();
            $table->integer('overtime')->nullable();
            $table->float('comp_off')->nullable(); // in case of overstay comp of will be calculated 1 or .5
            $table->float('comp_off_avail')->nullable();
            $table->string('shift_code')->nullable();
            $table->integer('hour_worked_minutes'); // store in minute
            $table->boolean('half_1'); // yes = 1, no = 0 or blank
            $table->boolean('half_2'); // yes = 1, no = 0 or blank
            $table->boolean('half_1_gate_pass')->nullable(); 
            $table->boolean('half_2_gate_pass')->nullable(); 
            $table->string('half_1_gp_out')->nullable();
            $table->string('half_1_gp_in')->nullable();
            $table->string('half_1_gp_hrs')->nullable();
            $table->string('half_2_gp_out')->nullable();
            $table->string('half_2_gp_in')->nullable();
            $table->string('half_2_gp_hrs')->nullable();

            $table->string('final_half_1')->nullable();
            $table->string('final_half_2')->nullable();

            $table->longText('remarks')->nullable();
            $table->boolean('is_manual_entry_done'); // yes =1 , no = 0 or blank

            $table->integer('deduction_minutes')->nullable();/////////////
            $table->string('status',1)->nullable();// checking holiday status

            $table->boolean('status'); // approved = 1, rejected = 0
            $table->integer('approved_by'); // employee_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manual_punches');
    }
}
