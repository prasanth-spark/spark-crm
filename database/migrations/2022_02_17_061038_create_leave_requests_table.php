<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->unsignedBigInteger('leave_type_id')->nullable();
            $table->foreign('leave_type_id')->references('id')->on('leave_types');
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('description')->nullable();
            $table->integer('leave_status')->default('0')->comment('1->pending,2->approved,3->rejected');  
            $table->string('start_date');
            $table->string('end_date')->nullable();
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
        Schema::dropIfExists('leave_requests');
    }
}
