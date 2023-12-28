<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\BaseReadOnlyController;
use App\Services\Address\StateService;

class StateController extends BaseReadOnlyController
{
    protected $service;
    public function __construct(StateService $service)
    {
        parent::__construct($service);
        $this->service = $service;
    }
}
