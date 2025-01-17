<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dpk extends Model
{
    protected $table = 'dpk';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
