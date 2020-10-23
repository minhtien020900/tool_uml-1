<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $connection = 'mysql_forum';
    protected $table ='mst_thread';
    protected $primaryKey = 'threađi';
    public function get(){
        return 'get';

    }
}
