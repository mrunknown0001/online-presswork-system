<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProofreadArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proofread_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->string('filename', 60)->nullable();
            $table->unsignedInteger('section_editor_id')->nullable();
            $table->foreign('section_editor_id')->references('id')->on('users');
            $table->unsignedInteger('eic_id')->nullable();
            $table->foreign('eic_id')->references('id')->on('users');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('proofread_articles');
    }
}
