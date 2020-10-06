<?php

namespace App\Entity;

use App\Services\VocabularyService;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VocabularyTest extends TestCase {

    public function test__construct() {

        $result = Cache::remember('vocabulary', 1000, function () {
            return VocabularyService::getAll();
        });
        dump($result);
        $this->assertIsArray($result);
    }
}
