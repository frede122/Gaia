<?php

namespace App\Helpers;

use App\Models\Address\State;
use Faker\Provider\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JsonSeeder
{

    public static function seed($json, $table)
    {
        $table = DB::table('states');
        $fields = json_decode($json, true);
        foreach ($fields as $key) {
            $table->insert($key);
        }
    }
}
