<?php

namespace Database\Seeders\Address;

use App\Models\Address\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'rua'      => 'admin',
            'number'      => '555',
            'neighborhood'      => 'campinhos',
            'cep'      => '123456',
            'city_id'  => 1,
            'id'  => 1,
        ]);
    }
}