<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


/**
 * Class User
 * @property string $name
 * @property string $email
* @property string $password

 * @package App\Models
 * @OA\Schema(
 *     schema="PostRequest",
 *     type="object",
 *     title="User",
 *     required={"name", "email", "password"},
 *     properties={
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string"),
 *         @OA\Property(property="password", type="string")
 *     }
 * )
 */

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, JWTSubject
{

    use Authenticatable, Authorizable;    // use Authenticatable, Authorizable;
    // use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}