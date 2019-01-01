<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User', 'correspondent_id');
    }

    public function publication()
    {
        return $this->belongsTo('App\Publication', 'publication_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }

    public function se()
    {
    	return $this->belongsTo('App\User', 'se_id');
    }

    public function version()
    {
        return $this->hasOne('App\ArticleVersion', 'article_id');
    }

    public function versionContents()
    {
        return $this->hasMany('App\ArticleVersionContent', 'article_id');
    }
}
