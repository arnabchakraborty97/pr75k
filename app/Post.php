<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;

    public function photos() {
    	return $this->hasMany('App\Photo');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

}
