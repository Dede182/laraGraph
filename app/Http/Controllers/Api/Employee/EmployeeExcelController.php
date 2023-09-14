<?php

namespace App\Http\Controllers\Api\Employee;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Jobs\Employee\Export\ExportEmployeeJob;
use App\Services\Employee\Export\EmployeeExportService;
use Illuminate\Support\Facades\Queue;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeExcelController extends Controller
{
    public function export()
    {
        $name = 'exportingEmployee_' . auth()->user()->id;
        $extension = request()->extension;
        $valid = EmployeeExportService::validExtension($extension);
        if($valid)
        {
            Bus::batch([
                new ExportEmployeeJob($extension),
            ])->name($name)->dispatch();
            return response()->json([
                "message" => "Employee data  start exporting to excel file"
            ]);
        }
    }

    public function download()
    {
        $extension = request()->extension;
        $valid = EmployeeExportService::validExtension($extension);
        $authId = auth()->user()->id ?? 1;
        if ($valid)
        {
            $fileName = 'employees.' . $extension;
            $queueName = 'exportingEmployee_' . $authId;
            $path = 'export/employees.' . $extension;
            $jobs = EmployeeExportService::getJobsByName($queueName);
            if ($jobs > 0)
            {
                return response()->json([
                    "message" => "Exporting employee data to excel file"
                ]);
            }
            return EmployeeExportService::download($path, $fileName);
        }
    }
}
