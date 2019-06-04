<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use function Jawira\PlantUml\encodep;

Class Project extends Model {

    protected $table    = 'project';
    protected $fillable = ['name', 'desc'];


}