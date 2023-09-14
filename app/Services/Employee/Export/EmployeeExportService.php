<?php

namespace App\Services\Employee\Export;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeExportService
{

    public static function getJobsByName(string $name)
    {
        return DB::table('job_batches')
        ->select('id','name')
        ->where('name', $name )
        ->where('finished_at', null)
        ->count();
    }

    public static function download(string $path,$fileName, $extension = 'xlsx')
    {
        $file = Storage::path($path);
        if (file_exists($file))
        {
            return response()->download($file,$fileName,[
                'Content-Type' => self::formatContentType($extension)
            ]);
        }
        return datamsg([
            'message' => 'File not found'
        ], 404);
    }

    public static function validExtension(string $extension)
    {
        $validExtension = ['xlsx','csv','html'];
        if (!in_array($extension, $validExtension))
        {
            throw new \Exception("Invalid extension & valid format are xlsx, csv, html");
        }

        return true;
    }

    protected static function formatContentType(string $extension)
    {
        $contentType = [
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'csv' => 'text/csv',
            'pdf' => 'application/pdf'
        ];

        return $contentType[$extension];
    }


}
