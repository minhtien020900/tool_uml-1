<?php

namespace App\Http\Controllers\Forum;

use App\Entity\Plantuml;
use App\Entity\PlantumlHistory;
use App\Entity\Project;
use App\Entity\Tag;
use App\Entity\Vocabulary;
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
use Symfony\Component\Process\Process;
use function Jawira\PlantUml\encodep;

class ForumController extends Controller {

    public function index(Request $request) {
        echo 123;
    }

}
