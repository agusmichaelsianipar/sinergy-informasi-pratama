<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'employee_id_number',       // YYYYMMDDYYYYMMGXXXXX
        'citizenship_id_no',
        'citizenship_id_file',
        'date_of_birth',
        'gender',
        'phone',
        'position',
        'street',
        'city_id',
        'city_name',
        'province_id',
        'province_name',
        'zip_code',
        'bank_account',
        'account_number',
        'deleted_at',
    ];

    const POSITION = [
        "president" => "President",
        "director" => "Director",
        "manager" => "Manager",
        "supervisor" => "Supervisor",
        "staff" => "Staff",
    ];
    const BANK_ACCOUNT = [
        "bni" => "Bank BNI",
        "bca" => "Bank BCA",
        "bri" => "Bank BRI",
        "mandiri" => "Bank Mandiri",
        "cimb" => "Bank CIMB Niaga",
    ];

    public static function next(){
        return static::max('id') + 1;
    }
}
