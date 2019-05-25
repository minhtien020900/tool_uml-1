<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use function Jawira\PlantUml\encodep;

Class Plantuml extends Model {

    protected $table    = 'plantuml';
    protected $fillable = ['name', 'url', 'code','user_id'];
}