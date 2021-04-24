<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExportCsvRequest;
use App\Services\ExportService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvExportController extends Controller
{
    private $exportService;

    /**
     * CsvExportController constructor.
     * @param ExportService $exportService
     */
    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    /**
     * Converts the user input into a CSV file and streams the file back to the user
     *
     * @param ExportCsvRequest $request
     * @return StreamedResponse
     */
    public function download(ExportCsvRequest $request): StreamedResponse
    {
        return $this->exportService->getCsvResponse($request->validated());
    }
}
