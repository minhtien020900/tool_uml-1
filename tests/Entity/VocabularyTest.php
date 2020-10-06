<?php

namespace App\Entity;

use Tests\TestCase;

class VocabularyTest extends TestCase {

    public function test__construct() {
        $data['id']   = 1;
        $data['text'] = 'にほんご';
        $v            = new Vocabulary($data);
        dd($v);
    }
}
