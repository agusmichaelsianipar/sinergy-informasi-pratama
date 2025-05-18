<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\Employee;
use App\Services\API\Emsifa;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
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

    public function fetchAllEmployee($request){

        $employees = $this->employeeRepos->query();

        if(isset($request->position)){

            $employees = $this->employeeRepos->filterByProperty($employees, "position", $request->position);
        }
        // return $employees->get();
        return DataTables::of($employees)
        ->addColumn('action', function($employee) {
            return '<ul class="list-inline d-inline-flex text-center">
                        <li class="list-inline-item" title="Edit Employee Data" style="line-height: 1;">
                            <a href="javascript:void(0)" data-employee="'.$employee->id.'"
                                data-url="/employees/'.$employee->employee_id_number.'"
                                data-firstname="'.$employee->user->firstname.'"
                                data-lastname="'.$employee->user->lastname.'" data-gender="'.$employee->gender.'"
                                data-date_of_birth="'.$employee->date_of_birth.'"
                                data-email="'.$employee->user->email.'" data-phone="'.$employee->phone.'"
                                data-citizenship_id_no="'.$employee->citizenship_id_no.'"
                                data-citizenship_id_file="'.url('/storage/' . $employee->citizenship_id_file).'"
                                data-street="'.$employee->street.'" data-province="'.$employee->province_id.'"
                                data-city="'.$employee->city_id.'" data-zip_code="'.$employee->zip_code.'"
                                data-position="'.$employee->position.'"
                                data-bank_account="'.$employee->bank_account.'"
                                data-account_number="'.$employee->account_number.'"
                                class="text-warning text-decoration-none mx-1" data-bs-toggle="modal"
                                data-bs-target="#updateEmployeeModal" style="font-size: 0.90rem;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </li>
                        <li class="list-inline-item" title="Delete Employee Data" style="line-height: 1;">
                            <a href="#" data-url="/employees/'.$employee->employee_id_number.'"
                                onclick="showDeleteAlert(`/employees/'.$employee->employee_id_number.'`)"
                                class="text-danger text-decoration-none mx-1" style="font-size: 0.90rem;">
                                <i class="fa fa-trash"></i>
                            </a>
                        </li>
                    </ul>';
        })->addColumn('name', function($employee){
            return $employee->user->firstname.' '.$employee->user->lastname;
        })->addColumn('email', function($employee){
            return $employee->user->email;
        })->editColumn('date_of_birth', function($employee) {
                return $employee->date_of_birth ? Carbon::parse($employee->date_of_birth)->format('d/m/Y') : '';
        })
        ->addColumn('citizenship_id', function($employee) {
            return '<a href="javascript:void(0)"
                        data-citizenship_id_file="'.url('/storage/'.$employee->citizenship_id_file).'"
                        data-bs-toggle="modal" data-bs-target="#showImageModal">
                        See File<i class="fa-solid fa-eye"></i>
                    </a>
                    <br>
                    '.$employee->citizenship_id_no.'';
        })->editColumn('bank_account', function($employee) {
            return $employee->bank_account.'<br>'.$employee->account_number;
        })->escapeColumns([])->toJson();
    }
    public function storeEmployee($request){


        if ($request->file('citizenship_id_file')) {
            $genderVal = $request->gender == "male" ? '1' : '2';
            $employe_id_number = Carbon::parse($request->date_of_birth)->format("Ymd").Carbon::now()->isoFormat("Ym").$genderVal.str_pad(Employee::next(), 5, "0", STR_PAD_LEFT);

            $province = $this->getProvinceByID($request->province);
            $city = $this->getCityByCityID($request->city);

            $filename = $employe_id_number."-Citizenship_Identity_File-".Carbon::now()->timestamp.'.'.$request->file('citizenship_id_file')->extension();
            
            // Unable to use google drive as storage manager
            // Can not found a way to retrieve the link (or not exploring yet)
            // Gdrive::put('Citizenship_Identity_File/'.$filename, $request->file('citizenship_id_file'));

            $identityFilename = $request->file('citizenship_id_file')->storeAs("Citizenship_Identity_File", $filename, 'public');

            $user = $this->userRepos->store([
                'firstname' => preg_replace('/\s+/', ' ', $request->firstname),
                'lastname' => preg_replace('/\s+/', ' ', $request->lastname),
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
        // dd(json_decode(json_encode($employeeIDNo)));
        
        $user = $this->userRepos->getUserByUserID($employee->user_id);

        $identityFilename = $employee->citizenship_id_file;
        if ($request->file('citizenship_id_file')) {

            $filename = $employee->employee_id_number."-Citizenship_Identity_File-".Carbon::now()->timestamp.'.'.$request->file('citizenship_id_file')->extension();

            $identityFilename = $request->file('citizenship_id_file')->storeAs("Citizenship_Identity_File", $filename, 'public');
        }

        $this->userRepos->update($user, [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]);

        $this->employeeRepos->update($employee, [
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
    public function destroyEmployee($employeeIDNo){

        $employee = $this->employeeRepos->getEmployeeByEmployeeID($employeeIDNo);
        
        $user = $this->userRepos->getUserByUserID($employee->user->id);
        $this->userRepos->update($user, [
            'user_status' => false,
        ]);
        
        $this->employeeRepos->delete($employee);
    }
}