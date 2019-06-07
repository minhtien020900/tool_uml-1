<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use function Jawira\PlantUml\encodep;

Class Plantuml extends Model {

    protected $table    = 'plantuml';
    protected $fillable = ['name', 'url', 'code', 'user_id','img'];
    //protected $with = ['project'];

    public function getUrlByCache() {
        return route('plantuml.show', $this->name);
    }

    public function project(){
        return $this->belongsTo('App\Entity\Project', 'project_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
    /**
     * Lấy source file img từ cache nếu ko có thì lấy trên server về
     *
     * @return false|string;
     */
    public function getDiagramByCache() {
        define("PATH_FILE_DIAGRAM", 'public/uml/');

        $hash_file_img_name = md5($this->url) . ".png";
        $path_file          = storage_path('app/' . PATH_FILE_DIAGRAM . $hash_file_img_name);

        if (file_exists($path_file)) {
            //todo: if is exists get in cache
            $file_string = file_get_contents($path_file);
        } else {
            // todo: if don't exitsts get in server
            $file_string = @file_get_contents('https://www.plantuml.com/plantuml/img/' . $this->url);
            if($file_string != ""){
                Storage::put('' . PATH_FILE_DIAGRAM . $hash_file_img_name, $file_string);
            }else{
                $hash_file_img_name = 'noIMG';
                $file_string = file_get_contents(storage_path('app/imgs/none_response.png'));
            }
        }
        $this->img  = $hash_file_img_name;
        $this->save();

        return $file_string;
    }
}