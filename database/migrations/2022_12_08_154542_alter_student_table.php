<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->tinyInteger('international')->default(1);
            $table->bigInteger('college_id')->unsigned()->nullable();
            $table->string('college_other', 300)->nullable();
        });

        Schema::table('student', function($table) {
            $table->foreign('college_id')->references('id')->on('college');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table) {
             $table->dropForeign(['college_id']);
             $table->dropColumn('international');
             $table->dropColumn('college_other');
        });
    }
}
