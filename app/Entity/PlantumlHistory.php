<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use function Jawira\PlantUml\encodep;

Class PlantumlHistory extends Model {

    protected $table    = 'plantuml_history';
    protected $fillable = ['old_id','name', 'url', 'code', 'user_id','project_id','img'];
    //protected $with = ['project'];
    public static function copyData(Plantuml $p) {
        $ph             = new self;
        $ph->old_id     = $p->id;
        $ph->code       = $p->code;
        $ph->name       = $p->name;
        $ph->url        = $p->url;
        $ph->project_id = $p->project->id;
        $ph->user_id    = $p->user_id;
        return $ph->save();
    }

    public static function getToView($id) {
        return self::where('old_id',$id)->orderBy('id','desc')->get();
    }

    public function getUrlByCache() {
        return route('plantuml.show', $this->id.'-'.$this->name);
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
    public function getUrlImg(){
        return '<img src="https://www.plantuml.com/plantuml/img/'.$this->url.'">';
    }
}
