<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Photo extends Model
{
    //
    protected $fillable = ['name'];

    public function user(){
    	return $this->hasMany('App\User');
    }
}
