<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProofreadArticle extends Model
{
    public function article()
    {
    	return $this->belongsTo('App\Article', 'article_id');
    }

    public function se()
    {
    	return $this->belongsTo('App\User', 'section_editor_id');
    }
}
