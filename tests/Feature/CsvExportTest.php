<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tests\TestCase;

class CsvExportTest extends TestCase
{
    public function testBasicValidation()
    {
        /** Attempting to export nothing */
        $response = $this->patchJson(route('csv.download'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testDistinctHeaders()
    {
        $tableData = $this->getTableData(3, 2);

        $tableData['headers'] = [
            ['title' => 'Same title'],
            ['title' => 'Same title'],
            ['title' => 'Another title']
        ];

        $response = $this->patchJson(route('csv.download'), $tableData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws \League\Csv\Exception
     */
    public function testFileDownload()
    {
        $tableData = $this->getTableData(rand(3, 5), rand(5, 10));
        $response = $this->patchJson(route('csv.download'), $tableData);

        $response->assertOk();
        $this->assertEquals(StreamedResponse::class, get_class($response->baseResponse));

        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->assertHeader('Content-Disposition', 'attachment;filename="table_data.csv"');

        $reader = Reader::createFromString($response->streamedContent());
        $reader->setHeaderOffset(0);

        $this->assertCount(count($tableData['rows']), $reader);
    }

    /**
     * @param int $headersCount
     * @param int $rowsCount
     * @return array[]
     */
    private function getTableData(int $headersCount, int $rowsCount): array
    {
        $headers = [];
        $rows = [];
        $row = [];

        for ($i = 0; $i < $headersCount; $i++) {
            $headers[] = ['title' => Str::random()];
            $row[] = ['val' => Str::random()];
        }

        for ($i = 0; $i < $rowsCount; $i++) {
            $rows[] = $row;
        }

        return [
            'headers' => $headers,
            'rows' => $rows
        ];
    }
}
