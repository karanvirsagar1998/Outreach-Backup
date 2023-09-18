<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('contact_number', 15)->nullable();
            $table->string('email', 50)->unique();
            $table->string('link', 200)->nullable();
            $table->text('about')->nullable();
            $table->text('skills', 200)->nullable();
            $table->string('rank', 200)->nullable();
            $table->tinyInteger('availability')->default(1); // 1 - available open for work otherwise not open for work
            $table->timestamps();
        });

        Schema::table('student', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
};
