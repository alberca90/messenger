<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function contact()
    {
        return $this->belongsTo('App\User');
    }
}
