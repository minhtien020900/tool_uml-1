<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mysql_forum';
    protected $table ='mst_post';
    protected $primaryKey = 'postid';
    public function get(){
        return 'get';

    }
}
