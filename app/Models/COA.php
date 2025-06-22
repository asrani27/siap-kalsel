<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class COA extends Model
{
    use HasFactory;
    protected $table = 'coa';
    protected $guarded = ['id'];
}
