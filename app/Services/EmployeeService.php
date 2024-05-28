<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    /**
     * Create a new employee.
     *
     * @param  array  $data
     * @return \App\Models\Employee
     */
    public function createEmployee(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return Employee::create($data);
    }

    /**
     * Update an existing employee.
     *
     * @param  \App\Models\Employee  $employee
     * @param  array  $data
     * @return \App\Models\Employee
     */
    public function updateEmployee(Employee $employee, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $employee->update($data);

        return $employee;
    }

    /**
     * Delete an employee.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleteEmployee(Employee $employee)
    {
        $employee->delete();
    }
}