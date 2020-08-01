<?php

namespace App\Http\Controllers\Plantuml;

use App\Entity\Plantuml;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use function Jawira\PlantUml\encodep;

class CategoryController extends Controller {
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
        $name = $request->input('name');
        $p = new Project;
        $p->name = $name;
        $p->desc = '';
        $p->save();

        Cache::forget('projects');

        return redirect('/');

    }
}
