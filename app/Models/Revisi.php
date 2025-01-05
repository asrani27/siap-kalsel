<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    protected $table = 'revisi_dpa';
    protected $guarded = ['id'];

    public function ikpa()
    {
        return $this->belongsTo(Ikpa::class);
    }
}
