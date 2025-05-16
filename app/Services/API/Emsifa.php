<?php

namespace App\Services\API;

use Config;
use Illuminate\Support\Facades\Http;


class Emsifa
{

    public static function getProvinces(){
        
        // just because it doesn't use any credentials, the link is used statically
        $endpoint = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($endpoint);

        return json_decode($response);
    }
    public static function getProvinceByID($provinceID){
        
        // just because it doesn't use any credentials, the link is used statically
        $endpoint = "https://www.emsifa.com/api-wilayah-indonesia/api/province/".$provinceID.".json";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($endpoint);
        return json_decode($response);
    }
    public static function getCitiesByProvinceID($provinceID){
        
        // just because it doesn't use any credentials, the link is used statically
        $endpoint = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/".$provinceID.".json";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($endpoint);
        return json_decode($response);
    }
    public static function getCityByCityID($cityID){
        
        // just because it doesn't use any credentials, the link is used statically
        $endpoint = "https://www.emsifa.com/api-wilayah-indonesia/api/regency/".$cityID.".json";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($endpoint);
        return json_decode($response);
    }
}