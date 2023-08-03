<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggaran;
use App\Models\KategoriPelanggaran;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Alert;
use PDF;

class LaporanPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tgl_satu=$request->tgl_satu;
        $tgl_dua=$request->tgl_dua;

        if ($request->tgl_satu || $request->tgl_dua) {
            $tgl_satu = Carbon::parse($request->tgl_satu)->toDateTimeString();
            $tgl_dua = Carbon::parse($request->tgl_dua)->toDateTimeString();

            $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,pelanggaran.created_at,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran,  kategoripelanggaran.poin,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->whereBetween('pelanggaran.created_at',[$tgl_satu,$tgl_dua])
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();
                    
                    if ($pelanggaran->isEmpty()) {
                         Alert::error('Terjadi Kesalahan','Data Tidak Ditemukan.');  

                    }

        } else {
         
         $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran,  kategoripelanggaran.poin,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();
            }
        return view('pages.admin.laporanpelanggaran.index',['pelanggaran'=>$pelanggaran, 'tgl_satu'=>$tgl_satu, 'tgl_dua'=>$tgl_dua]);
    }

    public function cetakpelanggaran(Request $request)
    {   
        date_default_timezone_set('Asia/Jakarta');
        $date = date('d - m - Y');
       
            $tgl_satu = Carbon::parse($request->tgl_satu)->toDateTimeString();
            $tgl_dua = Carbon::parse($request->tgl_dua)->toDateTimeString();

            $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,pelanggaran.created_at,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran,  kategoripelanggaran.poin,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->whereBetween('pelanggaran.created_at',[$tgl_satu,$tgl_dua])
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();
                    
         $pdf = PDF::loadview('pages.admin.laporanpelanggaran.cetakpelanggaran',['pelanggaran' =>$pelanggaran,'date' =>$date]);
          return $pdf->stream();
  
         
        
    }

    public function cetaksemuapelanggaran(Request $request)
    {   
        date_default_timezone_set('Asia/Jakarta');
        $date = date('d - m - Y');
       

            $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,pelanggaran.created_at,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran,  kategoripelanggaran.poin,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();
                    
         $pdf = PDF::loadview('pages.admin.laporanpelanggaran.cetakpelanggaran',['pelanggaran' =>$pelanggaran,'date' =>$date]);
          return $pdf->stream();
  
         
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
