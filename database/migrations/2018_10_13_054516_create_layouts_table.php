<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('layout_editor_id')->unsigned()->nullable();
            $table->foreign('layout_editor_id')->references('id')->on('users');
            $table->integer('publication_id')->unsigned();
            $table->foreign('publication_id')->references('id')->on('publications');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('filename', 50);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('eic_approved')->default(0);
            $table->timestamp('approved_date')->nullable();
            $table->tinyInteger('eic_denied')->default(0);
            $table->timestamp('denied_date')->nullable();
            $table->string('comment', 200)->nullable();
            $table->tinyInteger('le_comply')->default(0);
            $table->timestamp('comply_date')->nullable();
            $table->tinyInteger('admin_approved')->default(0);
            $table->timestamp('admin_approved_date')->nullable();
            $table->tinyInteger('admin_deny')->default(0);
            $table->timestamp('admin_deny_date')->nullable();
            $table->string('admin_comment', 200)->nullable();
            $table->tinyInteger('eic_comply')->default(0);
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
        Schema::dropIfExists('layouts');
    }
}
