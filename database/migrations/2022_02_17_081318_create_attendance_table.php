<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('attendance')->nullable()->comment('1->active,0->in-active');
            $table->integer('attendance_status')->nullable()->comment('0->absent,1->present,2->permission_accepted (leave),3->half day,4->permission_rejected');
            $table->integer('in_active')->nullable()->comment('null->not_taken_permission,1->permission,2->leave');
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('attendance');
    }
}
