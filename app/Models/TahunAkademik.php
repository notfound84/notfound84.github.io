<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;
    protected $table = 'tahunakademik';
    protected $primaryKey = 'id_tahunakademik';
    
    protected $fillable = [
        'nama_tahunakademik',
        'status'
        
    ];
    public function detailkelas(){
        return $this->hasMany(DetailKelas::class);
    }
    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
    public function rincianpembayaran(){
        return $this->hasMany(RincianPembayaran::class);
    }
}
