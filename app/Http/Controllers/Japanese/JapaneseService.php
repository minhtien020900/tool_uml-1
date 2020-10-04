<?php

namespace App\Http\Controllers\Japanese;

class JapaneseService {

    public function __construct() {
        $value = config('app.site_generate_mp3');
        if (!defined('SITE_GENERATE_MP3')) {
            define('SITE_GENERATE_MP3', $value);
        }
    }

    public static function read_sentence() {
        define('SITE_GENERATE_MP3', config('app.site_generate_mp3'));

        $MyGoogleSheet = new MyGoogleSheet;
        $senctence     = $MyGoogleSheet->get_sentence();
        define('EXTENTION', '.mp3');
        define('TIME_SLEEP', 5);
        $pathFolder = 'sentence';

        foreach ($senctence as $row) {
            $id           = $row[0];
            $lesson       = $row[1];
            $textSentence = $row[2];

            $pathStorageTmp = storage_path('tmp_audio/' . $pathFolder . '/Lesson' . $lesson . '/');
            @mkdir($pathStorageTmp);

            if ((int) $id <= 0) {
                continue;
            }

            $f = $textSentence ?? '';

            $filename = ($pathStorageTmp . $id . '_' . $f . EXTENTION);

            if (file_exists($filename)) {
                continue;
            }

            $textSentence = $textSentence ?? null;

            if (empty($textSentence)) {
                continue;
            }

            $textJA = $textSentence;
            if (!file_exists($filename)) {
                $url = SITE_GENERATE_MP3 . '/api/v1/utilities/get-mp3?text=' . urlencode($textJA) . '&lang=ja';
                echo $textJA;
                $content = file_get_contents($url);
                file_put_contents($filename, $content);
                sleep(TIME_SLEEP);
            }

        }
        dd($senctence);
    }


    public static function vn_to_str($str) {

        $unicode = [

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd' => 'đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i' => 'í|ì|ỉ|ĩ|ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D' => 'Đ',

            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        ];

        foreach ($unicode as $nonUnicode => $uni) {

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ', '_', $str);

        return $str;

    }


    public static function doctu(int $lesson) {
        $value = config('app.site_generate_mp3');
        if (!defined('SITE_GENERATE_MP3')) {
            define('SITE_GENERATE_MP3', $value);
        }
        if (!defined('EXTENTION')) {
            define('EXTENTION', '.mp3');
        }
        if (!defined('TIME_SLEEP')) {
            define('TIME_SLEEP', 5);
        }

        $MyGoogleSheet         = new MyGoogleSheet;
        $MyGoogleSheet->lesson = 'Bai' . $lesson;

        $values = $MyGoogleSheet->get();
        @mkdir(storage_path('tmp_audio/voca/'));
        @mkdir(storage_path('tmp_audio/voca/Lesson' . $lesson));

        foreach ($values as $v) {
            if (trim($v[5]) === '') {
                continue;
            }
            if ((int) $v[2] !== 1) {
                continue;
            }
            $f = $v[0] . '_' . $v[3] . '_' . self::vn_to_str($v[5]);

            $filepath = storage_path('tmp_audio/voca/Lesson' . $lesson . '/' . $f . EXTENTION);
            // dd($filepath);
            $filepathVI = $f . '_vi' . EXTENTION;

            $textJA = $v[1];
            $textVI = $v[5];

            if (!file_exists($filepath)) {
                $url = SITE_GENERATE_MP3 . '/api/v1/utilities/get-mp3?text=' . urlencode($textJA) . '&lang=ja';
                echo $textVI;
                $content = file_get_contents($url);
                file_put_contents($filepath, $content);
                sleep(TIME_SLEEP);
            }
        }


    }

    public static function doctuchem(int $lesson) {
        $value = config('app.site_generate_mp3');
        if (!defined('SITE_GENERATE_MP3')) {
            define('SITE_GENERATE_MP3', $value);
        }
        if (!defined('EXTENTION')) {
            define('EXTENTION', '.mp3');
        }
        if (!defined('TIME_SLEEP')) {
            define('TIME_SLEEP', 5);
        }
        if (!defined('SHEETNAME')) {
            define('SHEETNAME', 'tuchem');
        }
        if (!defined('FOLDERNAME')) {
            define('FOLDERNAME', 'tuchem');
        }
        $MyGoogleSheet         = new MyGoogleSheet;
        $MyGoogleSheet->lesson = SHEETNAME;

        $values = $MyGoogleSheet->get();
        @mkdir(storage_path('tmp_audio/' . FOLDERNAME . '/'));
        @mkdir(storage_path('tmp_audio/' . FOLDERNAME . '/Lesson' . $lesson));

        foreach ($values as $v) {

            $f = self::vn_to_str($v[0]);

            $filepath = storage_path('tmp_audio/' . FOLDERNAME . '/Lesson' . $lesson . '/' . $f . EXTENTION);

            $textJA = $v[0];

            if (!file_exists($filepath)) {
                $url = SITE_GENERATE_MP3 . '/api/v1/utilities/get-mp3?text=' . urlencode($textJA) . '&lang=vi';
                echo $textJA;
                $content = file_get_contents($url);
                if(strlen($filepath)>30){
                    $filepath = storage_path('tmp_audio/' . FOLDERNAME . '/Lesson' . $lesson . '/' . md5($f) . EXTENTION);

                }
                file_put_contents($filepath, $content);
                sleep(TIME_SLEEP);
            }
        }
    }
}
