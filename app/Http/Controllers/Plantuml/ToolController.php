<?php

namespace App\Http\Controllers\Plantuml;

use App\Entity\Plantuml;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function Jawira\PlantUml\encodep;

class ToolController extends Controller {

    public function index() {
        $puml = Plantuml::all();

        return view('plantuml/list', ['data' => $puml]);
    }

    public function create() {
        $puml             = Plantuml::all();
        $projects         = (Project::all());
        $puml['projects'] = $projects;

        return view('plantuml/create', $puml);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
        ]);
        try {
            if ($validator->failed()) {
                throw new \Exception('validate');
            }

            $name = $request->input('name');

            if (Plantuml::where(['name' => $name])
                        ->count() > 1) {
                $name = $name . "_" . str_random(3);
            }

            $hash = encodep($request->input('code'));

            Plantuml::firstOrCreate([
                'name'       => $name,
                'url'        => $hash,
                'code'       => $request->input('code'),
                'project_id' => $request->input('project'),
                'user_id'    => Auth::id()
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;

            return redirect(route('plantuml.create'))
                ->withErrors($validator)
                ->withInput();
        }

        return redirect(route('plantuml.index'));
    }

    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
        ]);
        try {
            if ($validator->fails()) {
                throw new \Exception('validate');
            }
            $hash = encodep($request->input('code'));
            /** @var Plantuml $p */
            $p = Plantuml::where(['name' => $request->input('name')])
                         ->first();

            $p->code       = $request->input('code');
            $p->url        = $hash;
            $p->project_id = $request->input('project');

            $p->save();

        } catch (\Exception $e) {
            return redirect(route('plantuml.edit', $request->input('name')))
                ->withErrors($validator)
                ->withInput();
        }

        $p->getDiagramByCache();

        return redirect(route('plantuml.index'));
    }

    public function show_url($project, $name = null) {
        if ($name == null) {
            $name = $project;
        }

        /** @var Plantuml $mm */
        $mm = (Plantuml::where(['name' => $name])
                       ->first());

        $im = $mm->getDiagramByCache();
        if ($mm->img == 'noIMG') {

        }
        header('Content-Type: image/png');

        return response($im)->header('Content-type', 'image/png');

    }

    public function edit($name) {

        $mm             = (Plantuml::where(['name' => $name])
                                   ->first());
        $mm['projects'] = Project::all();

        return view('plantuml/create', $mm);
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
