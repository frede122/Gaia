<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;


class RouterApi {

    public static function resource($uri, $controller)
    {
        Route::get($uri, $controller . '@index');
        Route::post($uri, $controller . '@store');
        Route::get($uri . '/{id}', $controller . '@show');
        Route::put($uri . '/{id}', $controller . '@update');
        Route::delete($uri . '/{id}', $controller . '@destroy');
    }
}