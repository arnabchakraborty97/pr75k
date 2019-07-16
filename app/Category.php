<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;

    public function videos() {
    	return $this->hasMany('App\Video');
    }

}
