<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function Post(){
        return $this->hasMany('App\Models\Post');
    }
}


