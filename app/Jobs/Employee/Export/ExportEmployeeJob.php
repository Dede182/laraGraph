<?php

namespace App\Jobs\Employee\Export;

use App\Exports\EmployeeExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExportEmployeeJob implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $extension;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $extension = 'xlsx')
    {
        $this->extension = $extension;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $queueName = 'export/employees.' . $this->extension;
        Log::info($queueName);
        (new EmployeeExport)->queue($queueName);
    }
}
