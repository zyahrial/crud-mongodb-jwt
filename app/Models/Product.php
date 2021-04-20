<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
	protected $table = 'product';
    protected $guarded = ['_id'];

    // public function store()
    // {
    //     return $this->hasMany(Store::class,'store_id');
    // }
}