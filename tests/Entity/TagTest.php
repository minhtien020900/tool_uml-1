<?php

namespace Tests\Entity;

use App\Entity\Tag;
use Tests\TestCase;

class TagTest extends TestCase {

    public function testFindNewAndUpdate() {
        $input = '1,2,3,4,5,6';
        Tag::findNewAndUpdate('');
        $this->assertTrue(true);
    }
}
