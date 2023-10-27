<?php

namespace App\Models\Persons;

use App\Models\Address\City;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;

class Person extends Model
{

    protected $with = ['city'];

    protected $fillable = [
        'name', 
        'cpf_cnpj', 
        'email',
        'phone',
        'city_id',
        'address'
    ];

    // public function city(){
    //     return City::where('id', 'city_id')->get();
    // }
    public function city() : HasOne{
        return $this->hasOne(City::class, 'id', 'city_id');
    }


}
