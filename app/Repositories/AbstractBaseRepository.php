<?php

namespace App\Repositories;

use App\Constants\Status;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractBaseRepository
{

    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        try {

            $data = $this->model->all();
            $data['status'] = Status::SUCCESS;

            return $data;
        } catch (Exception $e) {

            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }


    public function create($input)
    {
        try {
            // $input = $request->all();

            $data = $this->model->create($input);
            $data['status'] = Status::SUCCESS;

            return $data;
        } catch (\Exception $e) {

            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }


    public function get($id)
    {

        try {
            $data = $this->model->find($id);
            $data['status'] = Status::SUCCESS;

            return $data;
        } catch (\Exception $e) {

            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }



    public function update($input, $id)
    {
        try {

            $data = $this->model->find($id);
            if (!$data)
                return ['status' => Status::ERROR];

            // $input = $request->all();
            $newData = $data->update($input);
            $newData['status'] = Status::SUCCESS;
            return $newData;
        
        } catch (Exception $e) {

            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }


    public function delete($id)
    {
        try {

            $data = $this->model->find($id);
            if (!$data)
                return ['status' => Status::ERROR];

            $newData = $data->delete();
            $newData['status'] = Status::SUCCESS;
            return $newData;
        
        } catch (Exception $e) {

            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }
}