<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'middleware' => ['auth:parent']
    ],
    function () {

        Route::get('/parent_dashboard', function () {
            return view('pages.Parent.dashboard');
        });
    }
);

