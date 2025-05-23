<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function query();
    public function filterByProperty($employees, $property, $value);
    public function getEmployeeByEmployeeID($employeeIDNo);
    public function store($data);
    public function update($employee, $data);
    public function delete($employee);
}