<?php

namespace App\Repositories\Address;

use App\Contracts\Repository\Address\StateRepositoryInterface;
use App\Models\Address\State;
use App\Repositories\AbstractBaseRepository;

class StateRepository extends AbstractBaseRepository implements StateRepositoryInterface
{

    public function __construct(State $model)
    {
        parent::__construct($model);
    }

}
