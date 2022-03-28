<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->increments('employee_id');
            $table->string('father_name',50);
            $table->string('mother_name',50);
            $table->string('phone_number',20)->index('phone_number');
            $table->string('emergency_contact_number',20);
            $table->string('official_email');
            $table->date('joined_date');
            $table->text('home_address');
            $table->date('date_of_birth');
            $table->string('blood_group',5);
            $table->string('pan_number',50)->nullable();
            $table->string('aadhar_number',20)->nullable();
            $table->uuid('bank_id')->nullable()->index();
            $table->foreign('bank_id')->references('id')->on('bank_details');
            $table->string('account_holder_name',50)->nullable();
            $table->string('account_number',50)->nullable();
            $table->string('ifsc_code',20)->nullable();
            $table->string('branch_name',20)->nullable();
            $table->uuid('account_type_id')->nullable()->index();
            $table->foreign('account_type_id')->references('id')->on('account_types');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0-admin, 1-employee');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('user_details');
    }
}
