<?php

namespace App\Http\Controllers\Japanese;

use App\Console\Commands\MySpreadsheetSnippets;
use App\Console\Commands\SpreadsheetSnippets;
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

    public function get_sentence() {
        $s = new ServiceGoogle;
        $service = $s->getService();
        $spreadsheetId = '1PFurLYDNoZY70nbQhUmDbbtPGnSn8RWY1Bgz7GtlZdg';
        $range         = 'Sentence!A2:J';
        $response      = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values        = $response->getValues();
        return $values;
    }

    public function set_sentence($range,$data) {
        $s = new ServiceGoogle;
        $service = $s->getService();
        $spreadsheetId = '1PFurLYDNoZY70nbQhUmDbbtPGnSn8RWY1Bgz7GtlZdg';
        //$range         = 'Sentence!j1:z20';
        $snipet = new SpreadsheetSnippets($service);
        //$data = [[1],[1],[1],[1],[1],[1],[1]];
        $snipet->updateValues($spreadsheetId,$range,'USER_ENTERED',$data);
        $response      = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values        = $response->getValues();
        return $values;
    }
}
