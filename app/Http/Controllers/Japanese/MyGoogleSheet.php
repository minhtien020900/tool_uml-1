<?php

namespace App\Http\Controllers\Japanese;

use Google_Client;
use Google_Service_Sheets;

class MyGoogleSheet {

    /**
     * @var string
     */
    public $lesson = 'Bai1';

    public function get() {
        $s = new ServiceGoogle;
        $service = $s->getService();
        $spreadsheetId = '1PFurLYDNoZY70nbQhUmDbbtPGnSn8RWY1Bgz7GtlZdg';
        $range         = $this->lesson.'!A2:J';
        $response      = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values        = $response->getValues();
        return $values;
    }
}
