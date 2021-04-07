<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        dd($this->get('/info-from-package')->getStatusCode());
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
