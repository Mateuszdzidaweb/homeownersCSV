<?php

namespace App\Http\Controllers;

use App\Services\CsvImportService;
use App\Services\ProcessDataService;
use Illuminate\Http\Request;

class ImportFileController extends Controller
{
    protected $csvImportService;

    protected $processDataService;

    public function __construct(CsvImportService $csvImportService, ProcessDataService $processDataService)
    {

        $this->csvImportService = $csvImportService;
        $this->processDataService = $processDataService;
    }

    public function index()
    {
        return view('import-file');
    }

    public function processData(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|mimes:csv',
            ]);

            $lines = $this->csvImportService->readCvs($request->file('file'));

            $parseNames = $this->processDataService->parseFromCvs($lines);

            session(['homeowners_data' => $parseNames]);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return redirect()->route('import-csv.homeowners.show');

    }

    public function show()
    {
        $flattenedData = session('homeowners_data', []);

        return view('homeowners', ['data' => $flattenedData]);
    }
}
