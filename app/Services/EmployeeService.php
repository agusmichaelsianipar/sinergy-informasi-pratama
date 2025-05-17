<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Employee;
use App\Services\API\Emsifa;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeService extends Emsifa
{
    protected $userRepos, $employeeRepos;
    public function __construct(
        UserRepositoryInterface $userRepos,
        EmployeeRepositoryInterface $employeeRepos
        ){
        $this->userRepos = $userRepos;
        $this->employeeRepos = $employeeRepos;
    }

    public function storeEmployee($request){


        if ($request->file('citizenship_id_file')) {
    
            $employe_id_number = Carbon::parse($request->date_of_birth)->isoFormat("YYYYMMDD").Carbon::now()->isoFormat("YYYYMM").$request->gender == "male" ? '1' : '2'.str_pad(Employee::next(), 5, "0", STR_PAD_LEFT);

            $province = $this->getProvinceByID($request->province);
            $city = $this->getCityByCityID($request->city);

            $filename = $employe_id_number."-Citizenship_Identity_File-".Carbon::now()->timestamp.'.'.$request->file('citizenship_id_file')->extension();
            
            $identityFilename = $request->file('citizenship_id_file')->storeAs("Citizenship_Identity_File", $filename, 'public');

            $user = $this->userRepos->store([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make('sipsip123'),
                'user_status' => false,
                'is_admin' => false,
            ]);
            
            $this->employeeRepos->store([
                'user_id' => $user->id,
                'employee_id_number' => $employe_id_number,
                'citizenship_id_no' => $request->citizenship_id_no,
                'citizenship_id_file' => $identityFilename,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone' => str_replace('-', '', $request->phone),
                'position' => $request->position,
                'province_id' => $province->id,
                'province_name' => $province->name,
                'city_id' => $city->id,
                'city_name' => $city->name,
                'street' => $request->street,
                'zip_code' => $request->zip_code,
                'bank_account' => $request->bank_account,
                'account_number' => $request->account_number,
            ]);
        }else{

            throw new Exception("Citizenship identity file not found or unreadable.");
        }
    }
    public function updateEmployee($request, $employeeIDNo){

        $province = $this->getProvinceByID($request->province);
        $city = $this->getCityByCityID($request->city);

        $employee = $this->employeeRepos->getEmployeeByEmployeeID($employeeIDNo);
        
        $user = $this->userRepos->getUserByUserID($employee->user_id);

        $employe_id_number = Carbon::parse($request->date_of_birth)->isoFormat("YYYYMMDD").Carbon::now()->isoFormat("YYYYMM").$request->gender == "male" ? '1' : '2'.str_pad(Employee::next(), 5, "0", STR_PAD_LEFT);
        $identityFilename = $employee->citizenship_id_file;
        if ($request->file('citizenship_id_file')) {

            $filename = $employe_id_number."-Citizenship_Identity_File-".Carbon::now()->timestamp.'.'.$request->file('citizenship_id_file')->extension();

            $identityFilename = $request->file('citizenship_id_file')->storeAs("Citizenship_Identity_File", $filename, 'public');
        }

        $this->userRepos->update($user, [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]);

        $this->employeeRepos->update($employee, [
            'employee_id_number' => $employe_id_number,
            'citizenship_id_no' => $request->citizenship_id_no,
            'citizenship_id_file' => $identityFilename,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => str_replace('-', '', $request->phone),
            'position' => $request->position,
            'province_id' => $province->id,
            'province_name' => $province->name,
            'city_id' => $city->id,
            'city_name' => $city->name,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'bank_account' => $request->bank_account,
            'account_number' => $request->account_number,
        ]);

    }
}