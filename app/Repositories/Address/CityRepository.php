<?php

namespace App\Repositories\Address;

use App\Constants\Status;
use App\Contracts\Repository\Address\CityRepositoryInterface;
use App\Contracts\Repository\Person\UserRepositoryInterface;
use App\Models\Address\Address;
use App\Models\Address\City;
use App\Models\User;
use App\Repositories\AbstractBaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CityRepository extends AbstractBaseRepository implements CityRepositoryInterface
{

    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function getByStateId($id)
    {
        try {
            $data['data'] = $this->model->where('state_id', $id)->get();
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
}
