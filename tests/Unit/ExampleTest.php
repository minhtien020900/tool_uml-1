<?php

namespace Tests\Unit;

use App\Http\Controllers\Japanese\ServiceGoogle;
use Google_Service_Sheets_ValueRange;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
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
