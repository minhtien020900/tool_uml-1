<?php

namespace App\Entity;

use App\Services\VocabularyService;
use Tests\TestCase;

class VocabularyTest extends TestCase {

    public function test__construct() {
        $result = VocabularyService::getAll();
        $this->assertIsArray($result);
    }
}
