<?php

namespace Tests\Feature\Excel\Export;

use App\Exports\EmployeeExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class EmployeeExportTest extends TestCase
{

    public function test_excel_export_was_queued()
    {
        $this->AuthUser();

        Excel::fake();
        $this->get(route('employees.export', ['extension' => 'xlsx']));

        Excel::assertQueued('export/employees.xlsx', function(EmployeeExport $export) {
            return true;
        });
    }
}
