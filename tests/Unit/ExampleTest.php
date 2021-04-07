<?php

namespace Tests\Unit;

use package_examples\package_example_01\Services\InfoPersonVehicleService;
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
        $m = new InfoPersonVehicleService;
        dd($m->setInfoName('aødf')->getInfoName());
        dd($m->getInfoName());
        $this->assertTrue(true);
    }
}
