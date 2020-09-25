<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use function Jawira\PlantUml\encodep;

Class Tag extends Model {

    protected $table    = 'tags';
    protected $fillable = ['name'];

    public static function findNewAndUpdate(?string $input) {
        if(trim($input) === '' )return;
        $array_tag = (explode(',',$input));
        foreach ($array_tag as $v){
            Tag::firstOrCreate(["name"=>$v]);
        }
    }
}
