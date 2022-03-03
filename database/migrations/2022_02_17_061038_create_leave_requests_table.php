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
            $table->integer('permission_status')->nullable()->comment('0->permission_received,1->permission_accepted,2->permission_rejected,3->permission_denied');
            $table->integer('leave_status')->nullable()->default('0')->comment('0->leave_received,1->pending,2->approved,3->rejected');  
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
