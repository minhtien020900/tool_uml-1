<?php

namespace App;


use ChrisKonnertz\BBCode\BBCode;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mysql_forum';
    protected $table ='mst_post';
    protected $primaryKey = 'postid';
    protected $appends = array('html');
    public function get(){
        return 'get';

    }
    public function getHtmlAttribute(){
        //$bbcode = new ChrisKonnertz\BBCode\BBCode();
        $bbcode = new  BBCode();
        $rendered = $bbcode->render($this->pagetext);
        return $rendered;
        // Output: '<strong>Hello word!</strong>'
        return BBCode::convertToHtml($this->pagetext);

    }
}
