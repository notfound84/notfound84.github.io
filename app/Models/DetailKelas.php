<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKelas extends Model
{
    use HasFactory;
    protected $table = 'detailkelas';
    protected $primaryKey = 'id_detail_kelas';
    
    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'id_tahunakademik',
        'status_detail'
        
    ];
    public function siswa(){
        return $this->BelongsTo(Siswa::class,'id_siswa');
    }
    public function kelas(){
        return $this->BelongsTo(Kelas::class,'id_kelas');
    }
    public function tahunakademik(){
        return $this->BelongsTo(TahunAkademik::class,'id_tahunakademik');
    }
}
