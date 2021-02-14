<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = ['name', 'no_of_members', 'user_id'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
