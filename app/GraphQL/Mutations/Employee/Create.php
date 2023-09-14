<?php declare(strict_types=1);

namespace App\GraphQL\Mutations\Employee;

use App\Models\Employee;

final class Create
{
    /**
     * @param  array{}  $args
     */
    public function create($root, array $args)
    {
        $employee = $this->createEmployee($args);

        return [
            'status' => 'SUCCESS',
            'employee' => $employee
        ];
    }

    protected function createEmployee(array $args): Employee
    {
        return Employee::create([
            'first_name' => $args['first_name'],
            'last_name' => $args['last_name'],
            'email' => $args['email'],
            'phone' => $args['phone'],
            'department' => $args['department'],
            'user_id' => auth()->user()->id,
        ]);
    }
}
