<?php

namespace App\Jobs;

use App\Models\Patients;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GeneratePatientReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $startDate;
    protected $endDate;
    protected $filePath;

    public function __construct($startDate, $endDate, $filePath)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->filePath = $filePath;
    }

    public function handle()
    {
        ini_set('max_execution_time', 3600); // 1 hour
        ini_set('memory_limit', '2048M'); // 2GB

        $patientsQuery = Patients::whereBetween('created_at', [$this->startDate . " 00:00:00", $this->endDate . " 23:59:59"])->orderBy('created_at', 'desc');
        $chunkSize = 500;

        $allPatientsData = [];
        $patientsQuery->chunk($chunkSize, function ($patients) use (&$allPatientsData) {
            foreach ($patients as $patient) {
                $allPatientsData[] = $patient->toArray();
            }
        });

        $data = ['pat' => $allPatientsData];

        $pdf = PDF::loadView('pdf.patients', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->getDomPDF()->set_option('enable_html5_parser', true);

        Storage::put($this->filePath, $pdf->output()); // Save the PDF to storage
    }
}
