<?php

namespace App\Services;

use App\Thread;

class Forum {

    public static function getParentForum() {
        $forum1 = \App\Forum::where('parentid',-1)->get();
        foreach ($forum1 as $key=> $forum){
            $return[$key]['data'] = $forum;
            $return[$key]['child'] = \App\Forum::where('parentid',$forum->forumid)->get();



        }
        return $return;
    }

    public static function getDataCat(?string $cat) {
        return \App\Forum::where('parentid',$cat)->get();
    }

    public static function getDataThreadCat(?string $cat) {
        return \App\Thread::where('forumid',$cat)->get();
    }

    public static function getThreadData($threadid) {
        $return['mainthread'] =  \App\Thread::where('threadid',$threadid)->orderBy('threadid')->get();
        $return['commentthread'] = \App\Post::where('threadid',$threadid)->orderBy('postid')->get();
        return $return;
    }
}
