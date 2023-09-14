<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:api'])->group(function(){

    $EmployeeExportController = \App\Http\Controllers\Api\Employee\EmployeeExcelController::class;
    Route::get('/employees/export/excel/{extension}',[ $EmployeeExportController, 'export'])->name('employees.export');
    Route::get('/employees/export/download/{extension}',[ $EmployeeExportController, 'download'])->name('employees.download');

});
