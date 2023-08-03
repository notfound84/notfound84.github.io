<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    
    protected $fillable = [
        'nama_kelas'
        
    ];
    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
    public function detailkelas(){
        return $this->hasMany(DetailKelas::class);
    }
    public function rincianpembayaran(){
        return $this->hasMany(RincianPembayaran::class);
    }
    
    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }
}
