<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionEditorAssignment extends Model
{
    public function section()
    {
    	return $this->belongsTo('App\Section', 'section_id');
    }
}
