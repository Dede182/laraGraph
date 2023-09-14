<?php declare(strict_types=1);

namespace App\GraphQL\Mutations\Employee;
use App\Models\Employee;

final class Update
{
    /**
     * @param  array{}  $args
     */
    public function update($root, array $args)
    {
        $employee = $this->updateEmployee($args);

        return [
            'status' => 'SUCCESS',
            'employee' => $employee
        ];
    }

    protected function updateEmployee(array $args) : Employee
    {
        $employee = Employee::find($args['id']);
        $employee->first_name = $args['first_name'];
        $employee->last_name = $args['last_name'];
        $employee->email = $args['email'];
        $employee->phone = $args['phone'];
        $employee->department = $args['department'];
        $employee->user_id = auth()->user()->id;
        $employee->save();
        return $employee;
    }
}
