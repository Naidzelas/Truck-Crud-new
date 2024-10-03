<?php

use App\Http\Controllers\Transports\TransportController;
use Illuminate\Support\Facades\Route;

Route::resource('/', TransportController::class)->only([
    'index',
    'create',
    'destroy',
    'edit',
    'load',
    'store',
    'update',
]);