<?php

namespace App\Http\Controllers;

use App\Constants\ErrorMessage;
use App\Constants\Status;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseReadOnlyController extends Controller
{
    private $service;
    public function __construct($service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->service->getAll();

        $status = isset($result['status']) ? $result['status'] : null;
        return $this->responseWithJsonDefault($result, $status);
    }

    public function show($id)
    {
        $result =  $this->service->get($id);
        $status = $result['status'];
        return $this->responseWithJsonDefault($result, $status);
    }

    protected function responseWithJsonDefault($value, $status): JsonResponse
    {
        if (isset($status, $value))
            switch ($status) {
                case Status::SUCCESS:
                    return response()->json($value['data'], 200);
                    break;

                case Status::ERROR:
                    return response()->json($value, 500);
                    break;

            }
        return response()->json([
            'status' => Status::ERROR,
            'error' => ErrorMessage::FAIL
        ], 500);
    }

}
