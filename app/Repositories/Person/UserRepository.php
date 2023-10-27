<?php

namespace App\Repositories\Person;

use App\Constants\Status;
use App\Contracts\Repository\Person\UserRepositoryInterface;
use App\Models\Address\Address;
use App\Models\User;
use App\Repositories\AbstractBaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository extends AbstractBaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function create($request)
    {
        try {
            DB::beginTransaction();

            $inputAddress = $request->input('address');
            $address = new Address($inputAddress);
            $address->save();

            // $address->users()->create($inputUser);

            $inputUser = $request->except(['address']);
            $user = new User($inputUser);
            $user->password = $inputUser['password'];
            $user->address_id = $address->id;
            $user->save();
            DB::commit();

            $user->status = Status::SUCCESS;
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }

    public function updateEmail($email, $id)
    {

        try {
            $user = User::find($id);
            if (!$user)
                return ['status' => Status::ERROR];
            $user->email = $email;
            $user->save();
            $user['status'] = Status::SUCCESS;
            return $user;
        } catch (Exception $e) {
            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }

    public function updatePassword($password, $id)
    {

        try {
            $user = User::find($id);
            if (!$user)
                return ['status' => Status::ERROR];
            $user->password = $password;
            $user->save();
            $user['status'] = Status::SUCCESS;
            return $user;
        } catch (Exception $e) {

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
            DB::beginTransaction();
            $user = User::find($id);
            if (!$user)
                return ['status' => Status::ERROR];

            $user->name = $input['name'];
            $user->save();

            if (isset($input['address'])) {
                $address = Address::find($user->address['id']);
                $newAddress = $input['address'];
                $address->rua = $newAddress['rua'];
                $address->number = $newAddress['number'];
                $address->cep = $newAddress['cep'];
                $address->city_id = $newAddress['city_id'];
                $address->save();
                
            }
            DB::commit();

            $user['status'] = Status::SUCCESS;
            $user['address'] = $address;
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            $data = [
                'status' => Status::ERROR,
                'code error' => $e->getMessage()
            ];
            return $data;
        }
    }

    
}
