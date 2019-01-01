<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleVersionContent extends Model
{
    public function article()
    {
    	return $this->belongsTo('App\Article', 'article_id');
    }
}
