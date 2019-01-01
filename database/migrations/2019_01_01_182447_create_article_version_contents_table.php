<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleVersionContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_version_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->float('version', 3,2)->default(0);
            $table->longtext('content');
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
        Schema::dropIfExists('article_version_contents');
    }
}
