<?php

namespace App\Services\Person;

use App\Contracts\Repository\Person\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService {

    private $repo;
    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){
        return $this->repo->getAll();
    }

    public function get($id){
        return $this->repo->get($id);
    }
    public function create($data){
        $data['password'] = Hash::make($data['password']);
        return $this->repo->create($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function update($data, $id)
    {
        return $this->repo->update($data, $id);
    }

    public function updateEmail($data, $id)
    {
        return $this->repo->updateEmail($data, $id);
    }

    public function updatePassword($data, $id)
    {
        $password = Hash::make($data);
        return $this->repo->updatePassword($password, $id);
    }


}