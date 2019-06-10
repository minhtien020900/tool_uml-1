<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function order_by_uml($request, $puml) {
        if (Session::get('last_sort') != $request->input('sortby')) {
            $type_order = 'desc';
        } else {
            $type_order = 'asc';
        }
        $sort_by = $request->input('sortby');
        switch ($sort_by) {
            case 'project';
                $puml->orderBy('project_id', $type_order);
            break;
            case 'id';
                $puml->orderBy('id', $type_order);
            break;
            case 'name';
                $puml->orderBy('name', $type_order);
            break;
            case 'user';
                $puml->orderBy('user_id', $type_order);
            break;
        }
        Session::put('last_sort', $request->input('sortby'));

        return $puml;
    }

    protected function filter_uml(Request $request, $puml) {
        if ($request->input('project') != null) {
            $puml->where('project_id', $request->input('project'));
        }

        return $puml;
    }
}
