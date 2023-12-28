<?php

namespace App\Services\Address;

use App\Contracts\Repository\Address\CityRepositoryInterface;
use App\Contracts\Repository\Person\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CityService {

    private $repo;
    public function __construct(CityRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){
        return $this->repo->getAll();
    }

    public function get($id){
        return $this->repo->get($id);
    }
    public function getByStateId($id){
        return $this->repo->getByStateId($id);
    }




}