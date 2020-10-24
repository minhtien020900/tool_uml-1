<?php

namespace App\Http\Controllers\Forum;

use App\Entity\Plantuml;
use App\Entity\PlantumlHistory;
use App\Entity\Project;
use App\Entity\Tag;
use App\Entity\Vocabulary;
use App\Http\Controllers\Controller;
use App\Post;
use App\Thread;
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
        $data['data'] = \App\Services\Forum::getParentForum();

        return view('forum.index', $data);
    }

    public function forum(Request $request) {
        $cat                   = $request->input('cat');
        $dataCat               = \App\Services\Forum::getDataCat($cat);
        $dataThreadCat         = \App\Services\Forum::getDataThreadCat($cat);
        $data['dataCat']       = $dataCat;
        $data['dataThreadCat'] = $dataThreadCat;

        return view('forum.category', $data);
    }

    public function thread(Request $request) {
        $threadid       = $request->input('threadid');
        $dataThreadData = Cache::remember('thread_'.$threadid, 10000, function () use ($threadid) {
            return \App\Services\Forum::getThreadData($threadid);
        });
        //$dataThreadData = \App\Services\Forum::getThreadData($threadid);

        $data['dataThreadData'] = $dataThreadData;

        return view('forum.thread', $data);
    }

    public function getParentForum(Request $request) {
        return \App\Services\Forum::getParentForum();
    }

    public function getThread(Request $request, $id) {
        return Thread::where('forumid', $id)
                     ->get();

        return $id;

        return \App\Services\Forum::getParentForum();
    }

    public function getDetailThread(Request $request, $id) {
        return Post::where('threadid', $id)
                   ->get();

        return $id;

        return \App\Services\Forum::getParentForum();
    }


}
