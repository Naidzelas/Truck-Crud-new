<?php

use App\Http\Controllers\Transports\TransportUnitController;
use Illuminate\Support\Facades\Route;

Route::resource('/sub_unit', TransportUnitController::class)->only([
    'index',
    'create',
    'destroy',
    'edit',
    'load',
    'store',
    'update',
]);