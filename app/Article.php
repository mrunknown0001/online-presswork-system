<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User', 'corresponden_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }
}
