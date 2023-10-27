<?php

namespace App\Models\Address;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class City extends Model
{
    public $timestamps = false;
    protected $with = ["state"];
    protected $fillable = [
        'name', 
        'state_id'
    ];
    public function state(){
        return $this->hasOne(State::class, 'id', 'state_id');
    }

            /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'state_id',
    ];
}
