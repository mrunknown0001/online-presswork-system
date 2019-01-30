<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'lastname', 'password', 'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function section_assignment()
    {
        return $this->hasOne('App\SectionEditorAssignment', 'user_id');
    }


    public function articles()
    {
        return $this->hasMany('App\Article', 'correspondent_id');
    }


    public function layouts()
    {
        return $this->hasMany('App\Layout', 'layout_editor_id');
    }


    public function se_proofreaded()
    {
        return $this->hasMany('App\ProofreadArticle', 'section_editor_id')->whereActive(1);
    }
}
