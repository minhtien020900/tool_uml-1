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
        $l = $request->input('l',1);
        // Cache::forget('vocabularies'. $l);
        $vocabularies = Cache::remember('vocabularies'. $l, 1000, function () use ($l) {
            $data         = new MyGoogleSheet;
            $data->lesson = 'Bai' . $l;

            return $data->get();
        });
        //$vocabularies
        $vocabularies = array_filter($vocabularies, function ($e) {
            if (isset($e[6]) && $e[6] !== '') {
                return $e;
            }
        });
        View::share('vocabularies', $vocabularies);

        return view('japanese.list');
    }


    public function game(Request $request) {

        $l = $request->input('l',1);

        // Cache::forget('vocabularies'. $l);
        $vocabularies = Cache::remember('vocabularies'. $l, 1000, function ()  use ($l){
            $data         = new MyGoogleSheet;
            $data->lesson = 'Bai' . $l;

            return $data->get();
        });
        $vocabularies = array_filter($vocabularies, function ($e) {
            if (isset($e[6]) && $e[6] !== '') {
                return $e;
            }
        });
        View::share('vocabularies', $vocabularies);

        return view('japanese.game');
    }

    public function card(Request $request) {
        $lesson = $request->input('l',1);
        View::share('lesson', $lesson);


        return view('japanese.card');
    }

    public function test(Request $request) {
        $l = $request->input('l',1);

        // Cache::forget('vocabularies'. $l);
        $vocabularies = Cache::remember('vocabularies'. $l, 1000, function ()  use ($l){
            $data         = new MyGoogleSheet;
            $data->lesson = 'Bai' . $l;

            return $data->get();
        });
        $vocabularies = array_filter($vocabularies, function ($e) {
            if (isset($e[6]) && $e[6] !== '') {
                return $e;
            }
        });
        View::share('vocabularies', $vocabularies);

        return view('japanese.test');
    }

    public function audio(Request $request) {
        return view('japanese.audio');
    }
    public function pullsource(Request $request) {
        echo exec('git pull');
        // return view('japanese.audio');
    }



}
