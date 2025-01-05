<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RFK extends Model
{
    protected $table = 'rfk';
    protected $guarded = ['id'];

    public function okk()
    {
        return $this->hasMany(RFKokk::class, 'rfk_id');
    }
    public function hp()
    {
        return $this->hasMany(RFKhp::class, 'rfk_id');
    }
}
