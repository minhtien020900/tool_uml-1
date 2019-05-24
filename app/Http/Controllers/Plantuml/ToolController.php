<?php

namespace App\Http\Controllers\Plantuml;

use App\Entity\Plantuml;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Jawira\PlantUml\encodep;

class ToolController extends Controller {

    public function index() {
        $puml = Plantuml::all();

        return view('plantuml/list', ['data' => $puml]);
    }

    public function create() {
        $puml = Plantuml::all();

        return view('plantuml/create', ['data' => $puml]);
    }

    public function store(Request $request) {
        try{
            $name = $request->input('name');

            if(Plantuml::where(['name' => $name])->count() > 1){
                $name = $name."_".str_random(3);
            }

            $hash = encodep($request->input('code'));
            Plantuml::firstOrCreate(['name' => $name, 'url' => $hash, 'code' => $request->input('code')]);
        }catch (\Exception $e){
            Session::flash('error', 'Code không đúng');
        }


        return redirect(route('plantuml.index'));
    }

    public function update(Request $request) {
        $hash = encodep($request->input('code'));

        $p       = Plantuml::where(['name' => $request->input('name')])
                           ->first();

        $p->code = $request->input('code');
        $p->url  = $hash;
        $p->save();

        return redirect(route('plantuml.index'));
    }

    public function show_url($name) {

        $mm = (Plantuml::where(['name' => $name])
                       ->first());
//        echo('<img src=\'https://www.plantuml.com/plantuml/img/' . $mm->url . '\'>');

        //$file = public_path() . "/img/$image_name.png";
        $im = file_get_contents('https://www.plantuml.com/plantuml/img/' . $mm->url);
        header('Content-Type: image/png');
        return response($im)->header('Content-type','image/png');

    }

    public function edit($name) {

        $mm = (Plantuml::where(['name' => $name])
                       ->first());

        return view('plantuml/create', ['data' => $mm]);
    }

    public function build_uml(Request $request) {
        $hash = encodep($request->text);

        return [
            'planttext' => [
                'png'  => 'https://www.plantuml.com/plantuml/img/' . $hash,
                'svg'  => 'https://www.plantuml.com/plantuml/svg/' . $hash,
                'txt'  => 'https://www.plantuml.com/plantuml/txt/' . $hash,
                'edit' => 'https://www.planttext.com/?text=' . $hash,
            ],
            'tool'      => [
                // 'png'  => '/show_url//' . $hash,
                // 'svg'  => 'https://www.plantuml.com/plantuml/svg/' . $hash,
                // 'txt'  => 'https://www.plantuml.com/plantuml/txt/' . $hash,
                // 'edit' => 'https://www.planttext.com/?text=' . $hash,
            ],
        ];


    }
}
