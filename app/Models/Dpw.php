<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dpw extends Model
{
    protected $table = 'dpw';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
