<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{

    protected $table = 'monev';
    protected $guarded = ['id'];
    public $timestamps = false;
}
