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
        $rs            = self::ListSheet();
        foreach ($rs as $v) {
            $return[] = self::sheetData($service, $spreadsheetId, $v);
        }

        return $return;

    }

    private static function getMapping() {
        return [
            'id'           => 0,
            'text'         => 1,
            'flag'         => 2,
            'romazi'       => 3,
            'example'      => 4,
            'meaning'      => 5,
            'img'          => 6,
            'audio'        => 7,
            'sample'       => 8,
            'similarsound' => 9,
        ];
    }

    private static function ListSheet() {
        return ['Bai1', 'Bai2', 'Bai3', 'Bai4'];
    }

    private static function sheetData(\Google_Service_Sheets $service, string $spreadsheetId, string $sheet) {
        $range    = $sheet . '!A2:Z';
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values   = $response->getValues();
        $mapping  = self::getMapping();
        $result   = [];
        foreach ($values as $v) {
            if ($v === []) {
                continue;
            }
            $data = [
                'id'           => $v[$mapping['id']] ?? null,
                'text'         => $v[$mapping['text']] ?? null,
                'flag'         => $v[$mapping['flag']] ?? null,
                'romazi'       => $v[$mapping['romazi']] ?? null,
                'example'      => $v[$mapping['example']] ?? null,
                'meaning'      => $v[$mapping['meaning']] ?? null,
                'img'          => $v[$mapping['img']] ?? null,
                'audio'        => $v[$mapping['audio']] ?? null,
                'sample'       => $v[$mapping['sample']] ?? null,
                'similarsound' => $v[$mapping['similarsound']] ?? null,
            ];

            $result[$sheet][] = new Vocabulary($data);
        }

        return $result;
    }
}
