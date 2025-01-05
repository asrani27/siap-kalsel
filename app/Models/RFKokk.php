<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RFKokk extends Model
{
    protected $table = 'rfk_okk';
    protected $guarded = ['id'];

    public function rfk()
    {
        return $this->belongsTo(RFK::class, 'rfk_id');
    }
    public function sub()
    {
        return $this->hasMany(RFKokksub::class, 'rfk_okk_id');
    }
    public function getTotalVolumeAttribute()
    {
        return $this->sub->sum('volume');
    }
    public function getTotalHargaSatuanAttribute()
    {
        return $this->sub->sum('harga_satuan');
    }
    public function getTotalJumlahAnggaranAttribute()
    {
        return $this->sub->sum('jumlah_anggaran');
    }
    public function getTotalBobotPersenAttribute()
    {
        return $this->sub->sum('bobot_persen');
    }
    public function getTotalFisikRRAttribute()
    {
        $volumeTotal = $this->sub->sum('volume');

        if ($volumeTotal != 0) {
            return ($this->sub->sum('volume_rr') / $volumeTotal) * 100;
        } else {
            return 0;
        }
    }
    public function getTotalKeuanganRRAttribute()
    {
        return $this->sub->sum('keuangan_rr');
    }
    public function getTotalTertimbangRRAttribute()
    {
        return $this->sub->sum('tertimbang_rr');
    }
    public function getTotalJanAttribute()
    {
        return $this->sub->sum('jan');
    }
    public function getTotalFebAttribute()
    {
        return $this->sub->sum('feb');
    }
    public function getTotalMarAttribute()
    {
        return $this->sub->sum('mar');
    }
    public function getTotalAprAttribute()
    {
        return $this->sub->sum('apr');
    }
    public function getTotalMeiAttribute()
    {
        return $this->sub->sum('mei');
    }
    public function getTotalJunAttribute()
    {
        return $this->sub->sum('jun');
    }
    public function getTotalJulAttribute()
    {
        return $this->sub->sum('jul');
    }
    public function getTotalAugtAttribute()
    {
        return $this->sub->sum('Augt');
    }
    public function getTotalSeptAttribute()
    {
        return $this->sub->sum('sept');
    }
    public function getTotalOktAttribute()
    {
        return $this->sub->sum('okt');
    }
    public function getTotalNovAttribute()
    {
        return $this->sub->sum('nov');
    }
    public function getTotalDesAttribute()
    {
        return $this->sub->sum('des');
    }
    public function getTotalVolumeRFAttribute()
    {
        return $this->sub->sum('volume_rf');
    }
    public function getTotalFisikRFAttribute()
    {

        $volumeTotal = $this->sub->sum('volume');

        // Pastikan volume tidak nol
        if ($volumeTotal != 0) {
            return ($this->total_volume_rf / $volumeTotal) * 100;
        } else {
            return 0; // Jika volume 0, kembalikan nilai 0 atau nilai yang sesuai
        }
    }
    public function getTotalTertimbangRFAttribute()
    {
        $count = $this->sub->count();

        // Pastikan count tidak nol
        if ($count != 0) {
            return $this->sub->sum('tertimbang_rf') / $count;
        } else {
            return 0; // Jika count 0, kembalikan nilai 0 atau nilai yang sesuai
        }
        //return $this->sub->sum('tertimbang_rf') / $this->sub->count();
    }
    public function getTotalRupiahRKAttribute()
    {
        return $this->sub->sum('rupiah_rk');
    }
    public function getTotalPersenRKAttribute()
    {
        return $this->total_rupiah_rk != 0 ? $this->total_rupiah_rk / $this->total_jumlah_anggaran * 100 : 0;
    }
    public function getTotalTertimbangRKAttribute()
    {
        $count = $this->sub->count();

        // Pastikan count tidak nol
        if ($count != 0) {
            return $this->sub->sum('tertimbang_rk') / $count;
        } else {
            return 0; // Kembalikan 0 jika count 0
        }
    }
    public function getTotalSisaAnggaranAttribute()
    {
        return $this->sub->sum('sisa_anggaran');
    }
}
