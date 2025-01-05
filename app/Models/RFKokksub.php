<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RFKokksub extends Model
{
    protected $table = 'rfk_okk_sub';
    protected $guarded = ['id'];
    public function rfkokk()
    {
        return $this->belongsTo(RFKokk::class, 'rfk_okk_id');
    }
    public function getJumlahAnggaranAttribute()
    {
        return $this->volume * $this->harga_satuan;
    }
    public function getBobotPersenAttribute()
    {
        $totalJumlahAnggaran = $this->rfkokk->total_jumlah_anggaran;

        return $totalJumlahAnggaran != 0
            ? ($this->jumlah_anggaran / $totalJumlahAnggaran * 100)
            : 0;
    }
    public function getFisikRRAttribute()
    {
        return $this->volume != 0 ? $this->volume_rr / $this->volume * 100 : 0;
    }
    public function getKeuanganRRAttribute()
    {
        return $this->volume_rr * $this->harga_satuan;
    }
    public function getTertimbangRRAttribute()
    {
        if ($this->jumlah_anggaran != 0) {
            return ($this->keuangan_rr / $this->jumlah_anggaran * 100) * ($this->bobot_persen / 100);
        } else {
            return 0;
        }
    }
    public function getVolumeRFAttribute()
    {
        return $this->jan + $this->feb + $this->mar + $this->apr + $this->mei + $this->jun + $this->jul + $this->augt + $this->sept + $this->okt + $this->nov + $this->des;
    }
    public function getFisikRFAttribute()
    {
        return $this->volume_rf != 0 ? $this->volume_rf / $this->volume * 100 : 0;
    }
    public function getTertimbangRFAttribute()
    {
        return $this->fisik_rf != 0 ? $this->fisik_rf * $this->bobot_persen / 100 : 0;
    }
    public function getRupiahRKAttribute()
    {
        return $this->volume_rf != 0 ? $this->volume_rf * $this->harga_satuan : 0;
    }
    public function getPersenRKAttribute()
    {
        return $this->rupiah_rk != 0 ? $this->rupiah_rk / $this->jumlah_anggaran * 100 : 0;
    }
    public function getTertimbangRKAttribute()
    {
        return $this->persen_rk != 0 ? $this->persen_rk * $this->bobot_persen / 100 : 0;
    }
    public function getSisaAnggaranAttribute()
    {
        return $this->jumlah_anggaran - $this->rupiah_rk;
    }
}
