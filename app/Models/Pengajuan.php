<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'pengajuan_id');
    }
}
