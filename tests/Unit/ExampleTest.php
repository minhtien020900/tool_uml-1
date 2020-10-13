<?php

namespace Tests\Unit;

use App\Http\Controllers\Japanese\ServiceGoogle;
use App\Services\APIRedmineService;
use Google_Service_Sheets_ValueRange;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{

    public function testCreateTask() {
        APIRedmineService::createPackageTicket();
    }

    public function testName() {
        $files = Storage::disk('s3')->allFiles();
        foreach ($files as $f){
            Storage::disk('s3')->delete($f);
        }
        // return;
        for($i=0;$i<5;$i++){
            echo $i.PHP_EOL;
            $filePath = rand(0,10000).'/file_'.rand(0,1000000);
            Storage::disk('s3')->put($filePath,'sss','public');
            echo Storage::disk('s3')->get($filePath).PHP_EOL;

        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->markTestSkipped();
        return;
        $s = new ServiceGoogle;
        $service = $s->getService();
        $spreadsheetId = '1PFurLYDNoZY70nbQhUmDbbtPGnSn8RWY1Bgz7GtlZdg';
        $range         = 'Sentence!A22';
        $values=['1,2,3'];
        $requestBody = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $response      = $service->spreadsheets_values->update($spreadsheetId, $range,$requestBody);

    }
}
