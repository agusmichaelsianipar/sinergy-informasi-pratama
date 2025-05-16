<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FetchIndonesiaRegionAPIController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get/provinces', [FetchIndonesiaRegionAPIController::class, 'getProvinces']);
Route::get('/get/province/{provinceID}', [FetchIndonesiaRegionAPIController::class, 'getProvinceByID']);
Route::get('/get/cities/{provinceID}', [FetchIndonesiaRegionAPIController::class, 'getCitiesByProvinceID']);
Route::get('/get/city/{cityID}', [FetchIndonesiaRegionAPIController::class, 'getCityByCityID']);
Route::resource('employees', EmployeeController::class);