<?php

namespace App\Contracts\Repository\Address;

use App\Contracts\Repository\BaseReadOnlyRepositoryInterface;

interface CityRepositoryInterface extends BaseReadOnlyRepositoryInterface {

    public function getByStateId($id);

}