<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    
    protected $fillable = [
        'id_siswa',
        'tgl_pembayaran',
        'total_pembayaran',
        'id_petugas'
        
    ];
    public function siswa(){
        return $this->BelongsTo(siswa::class,'id_siswa');
    }
    
    public function user(){
        return $this->BelongsTo(User::class,'id_petugas');
    }
    public function detailpembayaran(){
        return $this->hasMany(DetailPembayaran::class);
    }
}
