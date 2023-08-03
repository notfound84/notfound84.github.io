<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianPembayaran extends Model
{
    use HasFactory;

    protected $table = 'rincianpembayaran';
    protected $primaryKey = 'id_rincianpembayaran';
    
    protected $fillable = [
        'uraian_pembayaran',
        'nominal',
        'id_kelas',
        'id_tahunakademik',
        'status'
    ];

    public function kelas(){
        return $this->BelongsTo(Kelas::class,'id_kelas');
    }
    public function tahunakademik(){
        return $this->BelongsTo(TahunAkademik::class,'id_tahunakademik');
    }
    static function list_rincianpembayaran(){
        $data = RincianPembayaran::all();
        return $data;
    }

    static function detail_rincianpembayaran($id_rincianpembayaran){
        $data = RincianPembayaran::
        join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas')
            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')->where("id_rincianpembayaran",$id_rincianpembayaran)->first();
        return $data;
    }
    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }
}
