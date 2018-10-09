<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleAttribsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_attribs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles');
            
            $table->tinyInteger('se_proofread')->default(0);
            $table->integer('se_id')->unsigned()->nullable();
            $table->foreign('se_id')->references('id')->on('users');
            $table->timestamp('se_proofread_date')->nullable();
            
            $table->tinyInteger('eic_proofread')->default(0);
            $table->integer('eic_id')->unsigned()->nullable();
            $table->foreign('eic_id')->references('id')->on('users');
            $table->timestamp('eic_proofread_date')->nullable();
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
        Schema::dropIfExists('article_attribs');
    }
}
