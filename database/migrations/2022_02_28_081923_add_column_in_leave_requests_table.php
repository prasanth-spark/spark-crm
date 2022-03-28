<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_type_id')->nullable()->after('leave_type_id');
            $table->foreign('permission_type_id')->references('id')->on('permission_types');
            $table->char('permission_hours_from', 250)->nullable()->after('leave_status');
            $table->char('permission_hours_to', 250)->nullable()->after('permission_hours_from');
            $table->integer('leave_counts')->nullable()->after('end_date');
            $table->integer('respond_status')->default(0)->comment('0->respond not filled,1->respond filled')->after('leave_counts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropColumn('permission_type_id'); 
            $table->dropColumn('permission_hours_from');
            $table->dropColumn('permission_hours_to'); 
            $table->dropColumn('respond_status'); 
        });
    }
}
