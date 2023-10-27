<?php

namespace Database\Seeders\Address;

use App\Models\Address\Address;
use App\Models\User;
use Database\Seeders\Address\CitySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdressControllerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(AddressSeeder::class);
    }
}