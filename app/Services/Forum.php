<?php

namespace App\Services;

class Forum {

    public static function getParentForum() {
        $forum1 = \App\Forum::where('parentid',-1)->get();
        foreach ($forum1 as $key=> $forum){
            $return[$key]['data'] = $forum;
            $return[$key]['child'] = \App\Forum::where('parentid',$forum->forumid)->get();



        }
        return $return;
    }
}
