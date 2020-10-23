<?php

namespace Tests;

use App\Forum;

trait ShowForum {
    private function getParentForum() {
        return (Forum::where('parentid', -1)
                     ->get());
    }
}
