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
use Illuminate\Support\Facades\View;
use function Jawira\PlantUml\encodep;

class ToolController extends Controller {

    public function __construct() {
        //parent::__construct();
        $projects = Project::all();
        View::share('projects', $projects);
    }


    public function index(Request $request) {

        $puml = Plantuml::where('active', 1);

        //<editor-fold desc="Order by">
        $puml = $this->order_by_uml($request, $puml);
        //</editor-fold>

        //<editor-fold desc="Order by">
        $puml = $this->filter_uml($request, $puml);
        //</editor-fold>

        $puml = $puml->get();

        return view('plantuml/list', ['data' => $puml]);
    }

    public function create() {
        $puml             = Plantuml::all();
        $projects         = (Project::all());
        $puml['projects'] = $projects;

        return view('plantuml/create', $puml);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        try {

            $name = $request->input('name');

            if (Plantuml::where(['name' => $name])
                        ->count() > 1) {
                $name = $name . "_" . str_random(3);
            }

            $hash = encodep($request->input('code'));

            $p = Plantuml::firstOrCreate([
                'name'       => $name,
                'url'        => $hash,
                'code'       => $request->input('code'),
                'project_id' => (int)$request->input('project'),
                'user_id'    => Auth::id()
            ]);
            $p->project_id =(int)$request->input('project');
            $p->save();

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
            if($p->user_id == Auth::id()){
                $p->code       = $request->input('code');
                $p->url        = $hash;
                $p->project_id = $request->input('project');

                $p->save();
            }else{
                $validator->getMessageBag()->add('authen','Don\'t have permission');
                throw new \Exception('Don\'t have permission');
            }


        } catch (\Exception $e) {
            return redirect(route('plantuml.edit', $request->input('name')))
                ->withErrors($validator)
                ->withInput();
        }

        $p->getDiagramByCache();

        return redirect(route('plantuml.index'));
    }

    public function show_url($project, $name = null, $type = null) {
        try {
            if ($name == null) {
                $name = $project;
            }
            preg_match('/^(.+)\..+$/', $name, $match);
            $real_name = $match[1] ?? $name;
            /** @var Plantuml $mm */
            $plantuml_element = (Plantuml::where(['name' => $real_name])
                                         ->first());
            if ($plantuml_element == null) {
                throw new \Exception('ádf');
            }
            //<editor-fold desc="Show by type">
            preg_match("/\.(png|svg|gif|jpg)$/", $name, $match);
            $ext_name = $match[1] ?? '';
            switch ($ext_name) {
                case 'svg':
                    $im = file_get_contents('https://www.plantuml.com/plantuml/svg/' . $plantuml_element->url);

                    return response($im)->header('Content-type', 'image/svg+xml');
                break;
                case 'png':
                case 'jpg':
                default:
                    $im = $plantuml_element->getDiagramByCache();

                    return response($im)->header('Content-type', 'image/png');
                break;
            }
            //</editor-fold>
        } catch (\Exception $e) {
            $im = file_get_contents(storage_path('app\imgs\none_response.png'));

            return response($im)->header('Content-type', 'image/png');
        }
    }

    public function edit($name) {

        $mm             = (Plantuml::where(['name' => $name])
                                   ->first());
        $mm['projects'] = Project::all();

        //dd($mm->user->name);
        return view('plantuml/create', ['uml'=>$mm]);
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

    public function showproject(Request $request, $name) {
        try {
            $p = Project::where('name', $name)
                        ->first();

            $puml = Plantuml::where('active', 1);

            //<editor-fold desc="Order by">
            $puml = $this->order_by_uml($request, $puml);
            //</editor-fold>

            //<editor-fold desc="Order by">
            $puml->where('project_id', $p->id);
            //</editor-fold>

            $puml = $puml->get();

            return view('plantuml/list', ['data' => $puml]);
        } catch (\Exception $e) {
            return redirect(route('404'))->with('error', $e->getMessage());
        }


    }

}
