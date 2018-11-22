<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public function publication()
    {
    	return $this->belongsTo('App\Publication', 'publication_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }

    public function version()
    {
    	return $this->hasOne('App\LayoutVersion', 'layout_id');
    }
}
