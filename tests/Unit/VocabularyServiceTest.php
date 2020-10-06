<?php

namespace App\Services;



use Tests\TestCase;

class VocabularyServiceTest extends TestCase {

    public function testGetAll() {
        $actual = VocabularyService::getAll();
        $this->assertIsArray($actual);
    }

    public function testGetByLesson() {
        $actual = VocabularyService::getByLesson(1);
        $this->assertIsArray($actual);
    }
}
