<?php

namespace App\Repository;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getEmployeeByEmployeeID($employeeIDNo){

        return Employee::where("employee_id_number", $employeeIDNo)->firstOrFail();
    }
    public function store($data){
        
        return Employee::create($data);
    }
    public function update($employee, $data){

        return tap($employee)->update($data);
    }
    public function delete($employee){

        return $employee->delete();
    }
}