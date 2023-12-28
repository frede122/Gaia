<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\BaseReadOnlyController;
use App\Http\Controllers\Controller;
use App\Services\Address\CityService;
use Illuminate\Http\Request;

class CityController extends BaseReadOnlyController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $service;
    public function __construct(CityService $service)
    {
        parent::__construct($service);
        $this->service = $service;
    }

    public function getByState($id)
    {
        $result =  $this->service->getByStateId($id);
        $status = $result['status'];
        return $this->responseWithJsonDefault($result, $status);
    }
}
