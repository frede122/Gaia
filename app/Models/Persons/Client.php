<?php

namespace App\Models\Persons;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Client extends Model
{

    protected $with = ['person'];
    protected $fillable = [
        'limit', 
        'lock',
        'person_id'
    ];

    public function person(){
        return $this->hasOne(Person::class, 'id', 'Person_id');
    }


}
