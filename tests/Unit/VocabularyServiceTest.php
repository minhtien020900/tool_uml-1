<?php

namespace App\Services;

use Redis;
use Tests\TestCase;

class VocabularyServiceTest extends TestCase {

    public function testGetAll() {
        $actual = VocabularyService::getAll();
        $this->assertIsArray($actual);
    }

    public function testRedis() {
        Redis::set('1', '1');
        $actual = Redis::get('1');
        $this->assertEquals('1', $actual);
    }


    public function testGetByLesson() {
        $actual = VocabularyService::getByLesson(1);
        $this->assertIsArray($actual);
    }
}
