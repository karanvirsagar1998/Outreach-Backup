<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('email', 50)->unique();
            $table->string('password', 100)->nullable();
            $table->bigInteger('user_type_id')->unsigned();
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('enable')->default(1);
            $table->timestamps();
        });

        Schema::table('users', function($table) {
            $table->foreign('user_type_id')->references('id')->on('user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
