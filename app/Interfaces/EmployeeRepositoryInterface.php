<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getEmployeeByEmployeeID($employeeIDNo);
    public function store($data);
    public function update($employee, $data);
}