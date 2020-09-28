<?php

namespace App\Http\Controllers\Japanese\api;

use App\Entity\Plantuml;
use App\Entity\PlantumlHistory;
use App\Entity\Project;
use App\Entity\Tag;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Japanese\MyGoogleSheet;
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

class APIJapaneseController extends Controller {

    public function card(Request $request){

        $l = $request->input('l',1);
        $vocabularies = Cache::remember('vocabularies'. $l, 1000, function () use ($l) {
            $data         = new MyGoogleSheet;
            $data->lesson = 'Bai' . $l;

            return $data->get();
        });
        return $vocabularies;
    }


}
