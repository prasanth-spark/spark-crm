<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_id');
            $table->date('date');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('project_name');
            $table->string('task_module');
            $table->integer('estimated_hours');
            $table->integer('worked_hours');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_sheets');
    }
}
