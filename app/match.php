<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class match extends Model
{
    

    protected $table = 'matches';

    public $primaryKey='id';

    public $timestamps=true;

}
