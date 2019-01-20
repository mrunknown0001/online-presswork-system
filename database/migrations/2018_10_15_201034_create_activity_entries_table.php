<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unsigned();
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->string('firstname', 30)->nullable();
            $table->string('middlename', 30)->nullable();
            $table->string('lastname', 30)->nullable();
            $table->string('student_number', 15)->nullable();
            $table->string('filename', 40);
            $table->string('email', 50);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('downloaded')->default(0);
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
        Schema::dropIfExists('activity_entries');
    }
}
