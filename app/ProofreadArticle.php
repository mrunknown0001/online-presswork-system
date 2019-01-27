<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProofreadArticle extends Model
{
    public function article()
    {
    	return $this->belongsTo('App\Article', 'article_id');
    }
}
