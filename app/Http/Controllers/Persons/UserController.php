<?php

namespace App\Http\Controllers\Persons;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Persons\Client;
use App\Services\Person\UserService;

class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

}
