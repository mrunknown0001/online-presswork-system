<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('correspondent_id')->unsigned();
            $table->foreign('correspondent_id')->references('id')->on('users');
            $table->string('title', 50);
            $table->longtext('content');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('viewing')->default(0);
            $table->integer('viewing_by')->unsigned()->nullable();

            $table->tinyInteger('se_proofread')->default(0);
            $table->integer('se_id')->unsigned()->nullable();
            $table->foreign('se_id')->references('id')->on('users');
            $table->timestamp('se_proofread_date')->nullable();

            $table->tinyInteger('se_deny')->default(0);
            $table->string('se_comment', 200)->nullable();
            $table->timestamp('se_deny_date')->nullable();
            $table->tinyInteger('correspondent_comply')->default(0);
            
            $table->tinyInteger('eic_proofread')->default(0);
            $table->integer('eic_id')->unsigned()->nullable();
            $table->foreign('eic_id')->references('id')->on('users');
            $table->timestamp('eic_proofread_date')->nullable();

            $table->tinyInteger('eic_deny')->default(0);
            $table->string('eic_comment', 200)->nullable();
            $table->timestamp('eic_deny_date')->nullable();
            $table->tinyInteger('se_comply')->default(0);

            $table->tinyInteger('admin_proofread')->default(0);
            $table->timestamp('admin_proofread_date')->nullable();

            $table->tinyInteger('admin_deny')->default(0);
            $table->string('admin_comment', 200)->nullable();
            $table->timestamp('admin_deny_date')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
