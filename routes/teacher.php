<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['auth:teacher']
    ],
    function () {

        Route::get('/teacher_dashboard', function () {
            return view('pages.Teachers.dashboard');
        });
    }
);
