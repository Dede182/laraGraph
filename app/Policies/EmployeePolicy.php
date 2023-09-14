<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function update(User $user,Employee $employee)
    {
        return $employee->user_id === auth()->user()->id;
    }

    public function delete(User $user,Employee $employee)
    {
        return $employee->user_id === auth()->user()->id;
    }


}
