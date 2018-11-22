<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutVersion extends Model
{
    public function layout()
    {
    	return $this->belongsTo('App\Layout', 'layout_id');
    }
}
