<?php

namespace App\Models\Address;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;

class Address extends Model
{
    public $timestamps = false;
    protected $with = ['city'];
    protected $fillable = [
        'rua', 
        'number',
        'neighborhood',
        'cep',
        'city_id'
    ];
    public function city() : HasOne{
        return $this->hasOne(City::class, 'id', 'city_id');
    }

        /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'city_id',
    ];
}
