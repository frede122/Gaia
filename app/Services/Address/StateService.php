<?php

namespace App\Services\Address;

use App\Contracts\Repository\Address\StateRepositoryInterface;

class StateService {

    private $repo;
    public function __construct(StateRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){
        return $this->repo->getAll();
    }

    public function get($id){
        return $this->repo->get($id);
    }




}