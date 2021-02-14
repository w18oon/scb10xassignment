<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['party_id', 'user_id'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function party()
    {
      return $this->belongsTo('App\Party');
    }
}
