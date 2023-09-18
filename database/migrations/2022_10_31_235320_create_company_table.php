<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('student_id')->unsigned();
            $table->string('name', 200);
            $table->text('job_description')->nullable();
            $table->string('link', 200)->nullable();
            $table->string('email', 50)->unique();
            $table->string('source', 200)->nullable();
            $table->string('other_specify', 200)->nullable();
            $table->string('contact_number', 15)->nullable();
            $table->bigInteger('status')->nullable();
            $table->timestamps();
        });

        Schema::table('company', function($table) {
            $table->foreign('student_id')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
};
