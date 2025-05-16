<?php

namespace App\Http\Controllers;

use App\Services\API\Emsifa;
use Illuminate\Http\Request;

class FetchIndonesiaRegionAPIController extends Controller
{
    public function getProvinces(){

        try {
            
            $provinces = Emsifa::getProvinces();

            return response()->json([
                "status" => true,
                "provinces"=> $provinces
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function getProvinceByID($provinceID){

        try {
            
            $cities = Emsifa::getProvinceByID($provinceID);

            return response()->json([
                "status" => true,
                "cities"=> $cities
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function getCitiesByProvinceID($provinceID){

        try {
            
            $cities = Emsifa::getCitiesByProvinceID($provinceID);

            return response()->json([
                "status" => true,
                "cities"=> $cities
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function getCityByCityID($cityID){

        try {
            
            $city = Emsifa::getCityByCityID($cityID);

            return response()->json([
                "status" => true,
                "city"=> $city
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
