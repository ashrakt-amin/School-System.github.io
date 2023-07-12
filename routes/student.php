<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'middleware' => ['auth:student']
    ],
    function () {

        Route::get('/student_dashboard', function () {
            return view('pages.Students.dashboard');
        });
    }
);


