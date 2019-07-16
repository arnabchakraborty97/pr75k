<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

}
