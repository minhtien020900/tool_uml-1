<?php

namespace App\Http\Controllers\Japanese;

use App\Entity\Plantuml;
use App\Entity\PlantumlHistory;
use App\Entity\Project;
use App\Entity\Tag;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Sheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use function Jawira\PlantUml\encodep;

class JapaneseController extends Controller {

    public function index(Request $request) {
        $values = MyGoogleSheet::get();

        foreach ($values as $v) {
            if ((int) $v[2] !== 1) {
                continue;
            }
            $f          = $v[0] . '_' . $v[3] . '_' . $this->vn_to_str($v[5]);
            $filename   = $f . EXTENTION;
            $filenameVI = $f . '_vi' . EXTENTION;

            $textJA = $v[1];
            $textVI = $v[5];

            if (!file_exists($filename) || !file_exists($filenameVI)) {
                $url = 'http://backend.sns.vn/api/v1/utilities/get-mp3?text=' . urlencode($textJA) . '&lang=ja';
                echo $url;
                $content = file_get_contents($url);
                file_put_contents($filename, $content);
                sleep(TIME_SLEEP);
                $url = 'http://backend.sns.vn/api/v1/utilities/get-mp3?text=' . urlencode($textVI) . '&lang=vi';
                echo $url;
                $content = file_get_contents($url);
                file_put_contents($filenameVI, $content);
                sleep(TIME_SLEEP);
                return;
            }

        }

    }

    function vn_to_str ($str){

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
