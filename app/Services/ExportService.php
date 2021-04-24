<?php


namespace App\Services;


use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportService
{
    /**
     * @param array $data
     * @return StreamedResponse
     */
    public function getCsvResponse(array $data): StreamedResponse
    {
        $fileName = 'table_data.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"'
        ];

        return new StreamedResponse(function() use($data) {
            $handle = fopen('php://output', 'w');

            /** CSV headers */
            $csvTitles = collect($data['headers'])->pluck('title')->all();
            fputcsv($handle, $csvTitles);

            foreach ($data['rows'] as $row) {
                $values = collect($row)->map(function($r) {
                    return $r['val'];
                })->all();

                fputcsv($handle, $values);
            }

            fclose($handle);

        }, Response::HTTP_OK, $headers);
    }
}
