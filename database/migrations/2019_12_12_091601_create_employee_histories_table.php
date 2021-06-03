<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('SET NULL');
            $table->date('joined_date');
            $table->string('position','64');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('section_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->date('resigned_date')->nullable()->default(null);
            $table->unsignedBigInteger('supervisor_id')->nullable()->default(null);
            $table->foreign('supervisor_id')->references('id')->on('admins')->onDelete('SET NULL');
            $table->text('review')->nullable()->default(null);
            $table->boolean('status');
            $table->time('shift_from');
            $table->time('shift_to');
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('SET NULL');
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('SET NULL');
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('SET NULL');
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
        Schema::dropIfExists('employee_histories');
    }
}
