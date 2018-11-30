<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpenPublication extends Model
{
    public function publication()
    {
    	return $this->belongsTo('App\Publication', 'publication_id');
    }

    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }

    
}
