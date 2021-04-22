<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Class Product
 * @property string $_id

 * @package App\Models
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="User",
 *     required={"_id"},
 *     properties={
 *         @OA\Property(property="_id", type="string")
 *     }
 * )
 */

class Product extends Eloquent
{
	protected $table = 'product';
    protected $guarded = ['_id'];

    // public function store()
    // {
    //     return $this->hasMany(Store::class,'store_id');
    // }
}