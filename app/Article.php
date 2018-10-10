<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User', 'correspondent_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }

    public function se()
    {
    	return $this->belongsTo('App\User', 'se_id');
    }
}
