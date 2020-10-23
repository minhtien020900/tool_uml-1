<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $connection = 'mysql_forum';
    protected $table ='mst_forum';
    protected $primaryKey = 'forumid';
    public function get(){
        return 'get';

    }
}
