<?php

namespace Tests\Entity;

use App\Entity\Plantuml;
use Tests\TestCase;

class PlantumlTest extends TestCase {

    public function testGetUrlImg() {
        $p = Plantuml::first();

        dd($p->getUrlImg());
    }
}
