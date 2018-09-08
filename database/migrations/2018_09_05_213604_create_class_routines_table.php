<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('class_routines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('institution_id');
            $table->string('shift_id');
            $table->string('timing_id');
            $table->string('grade_id');
            $table->string('section_id');
            $table->string('subject_name');
            $table->string('teacher_id');

            $table->timestamps();
            $table->unique(array('institution_id','shift_id','timing_id','grade_id','section_id'),'unique_routine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_routines');
    }
}
