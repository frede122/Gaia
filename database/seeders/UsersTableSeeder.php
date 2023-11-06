<?php

namespace Database\Seeders;

use App\Models\Address\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'admin',
            'birth_date'      => '2000-01-01 01:01:01',
            'email'     => 'admin@meusite.com.br',
            'password'  => Hash::make('123456'),
            'address_id'  => 1,
        ]);

        
    }
}