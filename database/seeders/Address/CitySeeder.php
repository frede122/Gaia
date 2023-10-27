<?php

namespace Database\Seeders\Address;

use App\Models\Address\Address;
use App\Models\Address\City;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name'      => 'Ibaiti',
            'state_id'     => 1,
            'id'  => 1
        ]);
    }
}