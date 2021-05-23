<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_time', function (Blueprint $table) {
            $table->integer('doctor_id')->unsigned();
            $table->tinyInteger('day')->unsigned(); //星期幾
            $table->tinyInteger('time_zone')->unsigned(); //哪一個時段 上午 中午 下午 代表 0 1 2
            $table->time('start_at');
            $table->time('end_at');
            $table->primary(['doctor_id', 'day', 'time_zone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosis_time');
    }
}