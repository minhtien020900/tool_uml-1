<?php

namespace Tests;

use App\Forum;
use App\Post;

use Genert\BBCode\Facades\BBCode;
use Illuminate\Support\Facades\Cache;

class PostTest extends TestCase {
    use ShowForum;
    public function testGet() {

        $forum = $this->getParentForum();
        //dd($forum);
        $bbCode = new BBCode();
dd(Post::first());
        // Output: '<strong>Hello word!</strong>'
        $bbCode->convertToHtml('[b]Hello word![/b]');
    }




}
