<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use function Jawira\PlantUml\encodep;

Class Tag extends Model {

    protected $table    = 'tags';
    protected $fillable = [];

}
