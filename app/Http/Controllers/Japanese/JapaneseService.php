<?php

namespace App\Http\Controllers\Japanese;

class JapaneseService {
    public function __construct() {
        $value = config('app.site_generate_mp3');
        if(!defined('SITE_GENERATE_MP3'))define('SITE_GENERATE_MP3',$value);
    }

    public static function generate() {
        $value = config('app.site_generate_mp3');
        if(!defined('SITE_GENERATE_MP3'))define('SITE_GENERATE_MP3',$value);
        if(!defined('EXTENTION'))define('EXTENTION','.mp3');
        if(!defined('TIME_SLEEP'))define('TIME_SLEEP',5);

        $MyGoogleSheet = new MyGoogleSheet;
        $MyGoogleSheet->lesson = 'Bai3';

        $values = $MyGoogleSheet->get();

        foreach ($values as $v) {
            if (trim($v[5]) === '') {
                continue;
            }
            if ((int) $v[2] !== 1) {
                continue;
            }
            $f          = $v[0] . '_' . $v[3] . '_' . self::vn_to_str($v[5]);
            $filename   = $f . EXTENTION;
            $filenameVI = $f . '_vi' . EXTENTION;

            $textJA = $v[1];
            $textVI = $v[5];


            if (!file_exists($filename)) {
                $url = SITE_GENERATE_MP3.'/api/v1/utilities/get-mp3?text=' . urlencode($textJA) . '&lang=ja';
                echo $textVI;
                $content = file_get_contents($url);
                file_put_contents($filename, $content);
                sleep(TIME_SLEEP);
            }

        }
    }


    public static function read_sentence() {
        define('SITE_GENERATE_MP3','http://backend.laka.vn');
        $MyGoogleSheet = new MyGoogleSheet;
        $senctence = $MyGoogleSheet->get_sentence();
        define('EXTENTION','.mp3');
        define('TIME_SLEEP',5);

        foreach ($senctence as $row){
            $f          = $row[0]??'';
            $filename   = $f . EXTENTION;
            if(file_exists($filename)){
                continue;
             }
            // if ((int) $v[2] !== 1) {
            //     continue;
            // }
            $row[0] = $row[0]??null;

            if(empty($row[0]) ){
                continue;
            }


            $textJA = $row[0];
            if (!file_exists($filename)) {
                $url = SITE_GENERATE_MP3.'/api/v1/utilities/get-mp3?text=' . urlencode($textJA) . '&lang=ja';
                echo $textJA;
                $content = file_get_contents($url);
                file_put_contents($filename, $content);
                sleep(TIME_SLEEP);

            }

        }
        dd($senctence);
    }


    public static function vn_to_str ($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ','_',$str);

        return $str;

    }
}
