<?php

namespace App\Services;

use App\Entity\Vocabulary;
use App\Http\Controllers\Japanese\ServiceGoogle;

class VocabularyService {

    public static function getAll() {
        $s = new ServiceGoogle;
        $s->getService();
        $service       = $s->getService();
        $spreadsheetId = config('vocabulary.idSheet');
        $rs = self::ListSheet();
        foreach ($rs as $v){
            $return[] = self::sheetData($service,$spreadsheetId,$v);
        }
        return $return;

    }

    private static function getMapping() {
        return ['id' => 0,'text' => 1];
    }

    private static function ListSheet() {
        return ['Bai1','Bai2','Bai3'];
    }

    private static function sheetData(\Google_Service_Sheets $service, string $spreadsheetId, string $sheet) {
        $range         = $sheet.'!A2:Z';
        $response      = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values        = $response->getValues();
        $mapping       = self::getMapping();

        foreach ($values as $v) {
            if ($v === []) {
                continue;
            }
            $result[$sheet] = new Vocabulary(['id' => $v[$mapping['id']], 'text' => $v[$mapping['text']]]);
        }
        return $result;
    }
}
