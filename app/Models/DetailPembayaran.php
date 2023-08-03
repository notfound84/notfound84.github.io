<?php

namespace App\Models;

use App\Models\RincianPembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembayaran extends Model
{
    use HasFactory;
    protected $table = 'detailpembayaran';
    protected $primaryKey = 'id_detailpembayaran';
    
    protected $fillable = [
        'id_pembayaran',
        'id_rincianpembayaran'
        
    ];
    public function pembayaran(){
        return $this->BelongsTo(Pembayaran::class,'id_pembayaran');
    }
    public function rincianpembayaran(){
        return $this->BelongsTo(RincianPembayaran::class,'id_rincianpembayaran');
    }
}
