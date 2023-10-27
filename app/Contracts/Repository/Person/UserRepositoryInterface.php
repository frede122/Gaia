<?php

namespace App\Contracts\Repository\Person;

use App\Contracts\Repository\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface{

    public function updateEmail($data, $id);
    public function updatePassword($data, $id);

}