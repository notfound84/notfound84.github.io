<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $guarded=[];

    protected $fillable = [
        'nisn',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'id_kelas',
        'id_tahunakademik',
        'status_siswa'
    ];
    public function kelas(){
        return $this->BelongsTo(Kelas::class,'id_kelas');
    }
    public function tahunakademik(){
        return $this->BelongsTo(TahunAkademik::class,'id_tahunakademik');
    }
    public function detailkelas(){
        return $this->hasMany(DetailKelas::class);
    }
    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }
    static function detail_siswa($nisn){
        $data = Siswa::where("nisn",$nisn)->first();
        return $data;
    }
}
