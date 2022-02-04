<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('employee_id')->primary()->index();
            $table->string('name')->index('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone_number')->index('phone_number');
            $table->string('emergency_contact_number');
            $table->string('email')->unique()->index('email');
            $table->string('official_email')->unique();
            $table->date('joined_date');
            $table->text('home_address');
            $table->date('data_of_birth');
            $table->string('blood_group');
            $table->string('pan_number');
            $table->string('aadhar_number');
            $table->uuid('bank_id')->nullable(false)->index();
            $table->foreign('bank_id')->references('id')->on('bank_details')->onDelete('cascade');
            $table->string('account_holder_name');
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->string('branch_name');
            $table->uuid('account_type_id')->nullable(false)->index();
            $table->foreign('account_type_id')->references('id')->on('account_types')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->comment('0-active, 1-inactive');
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
        Schema::dropIfExists('employees');
    }
}
