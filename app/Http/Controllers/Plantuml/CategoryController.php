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

class CategoryController extends Controller {

    public function __construct() {
        //parent::__construct();
        $projects = Project::all();
        View::share('projects', $projects);
    }


    public function index(Request $request) {

        $puml = Plantuml::where('active', 1);
        $puml = Plantuml::where('user_id', $request->input("id"));

        //<editor-fold desc="Order by">
        $puml = $this->order_by_uml($request, $puml);
        //</editor-fold>

        //<editor-fold desc="Order by">
        $puml = $this->filter_uml($request, $puml);
        //</editor-fold>

        $puml = $puml->get();
        View::share('name_page','UML by User');
        return view('plantuml/list', ['data' => $puml]);
    }


}
