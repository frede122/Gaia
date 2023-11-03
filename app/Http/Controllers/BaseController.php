<?php

namespace App\Http\Controllers;

use App\Constants\ErrorMessage;
use App\Constants\Status;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request)
            response()->json([
                'status' => Status::ERROR,
                'error' => ErrorMessage::NULL_FIELDS
            ], 400);

        $result = $this->service->create($request);
        $status = $result['status'];
        return $this->responseWithJsonDefault($result, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result =  $this->service->get($id);
        $status = $result['status'];
        return $this->responseWithJsonDefault($result, $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->service->update($request, $id);
        $status = $result['status'];
        return $this->responseWithJsonDefault($result, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->delete($id);
        $status = $result['status'];
        return $this->responseWithJsonDefault($result, $status);
    }

    protected function responseWithJsonDefault($data, $status): JsonResponse
    {
        if (isset($status, $data))
            switch ($status) {
                case Status::SUCCESS:
                    return response()->json($data, 200);
                    break;

                case Status::ERROR:
                    return response()->json($data, 500);
                    break;

            }
        return response()->json([
            'status' => Status::ERROR,
            'error' => ErrorMessage::FAIL
        ], 500);
    }
}
