<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Throwable;

class EmployeeExport implements FromView,WithColumnWidths
{
    use Exportable;

    public function query()
    {
        return Employee::query()->select([
            'id',
            DB::raw('CONCAT(first_name, " ", last_name) AS full_name'),
            'email',
            'phone',
            'department',
            DB::raw('(SELECT name FROM users WHERE id = employees.user_id) AS user_name'),
            'hire_date'
        ])->with('user'); // Assuming there's a "user" relationship in your Employee model
    }


    public function view()  : View
    {
        $columns = $this->getHeaders();
        return view('exports.employees.list',[
            'employees' => $this->query()->limit(10)->get(),
            'columns' => $columns
        ]);
    }

    public function failed(Throwable $exception): void
    {
        // Implement failed() method.
        Log::error($exception->getMessage());
    }

    protected function getHeaders() : array
    {
        return [
            'Id',
            'Full Name',
            'Email',
            'Phone',
            'Department',
            'Created By',
            'Hire at',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 20,
            'F' => 25,
            'G' => 25,
        ];
    }


}
