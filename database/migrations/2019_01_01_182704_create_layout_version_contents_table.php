<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutVersionContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_version_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('layout_id');
            $table->foreign('layout_id')->references('id')->on('layouts');
            $table->float('version', 3,2)->default(0);
            $table->string('filename', 50);
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
        Schema::dropIfExists('layout_version_contents');
    }
}
