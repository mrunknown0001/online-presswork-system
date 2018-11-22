<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function open_publication()
    {
    	return $this->hasMany('App\OpenPublication', 'publication_id');
    }
}
