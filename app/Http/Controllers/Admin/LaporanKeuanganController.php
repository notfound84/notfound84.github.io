<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\DetailKelas;
use App\Models\DetailPembayaran;
use App\Models\TahunAkademik;
use App\Models\RincianPembayaran;
use Carbon\Carbon;
use Alert;
use PDF;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $kelascari = $request->kelascari;
                
        $tahun = $request->tahun;
        $pilihkelas = $request->kelas;

         $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

        $kelas = Kelas::all();
        
        if (!empty($tahun)) {
            
         $detailpembayaran = DetailPembayaran::join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
                                            ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas') 
                                            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')                                       
                                            ->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'detailpembayaran.id_pembayaran')
                                            ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
                                            ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                                            ->where('kelas.nama_kelas', '=', $kelascari)
                                            ->get()->groupBy('id_siswa');

                    if ($detailpembayaran->isEmpty()) {
                         Alert::error('Terjadi Kesalahan','Data Tidak Ditemukan.');  

                    } else {
                         return view('pages.admin.laporankeuangan.index', [  'tahunajar' => $tahunajar, 'kelas' => $kelas, 'detailpembayaran'=>$detailpembayaran,'tahun' => $tahun,'kelascari' => $kelascari]);

                    }
       
            } else {

                $detailpembayaran = DetailPembayaran::join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
                                            ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas') 
                                            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')                                       
                                            ->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'detailpembayaran.id_pembayaran')
                                            ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
                                            ->get()->groupBy('id_siswa');

            }

   
        return view('pages.admin.laporankeuangan.index', [  'tahunajar' => $tahunajar, 'kelas' => $kelas, 'detailpembayaran'=>$detailpembayaran,'tahun' => $tahun, 'kelascari' => $kelascari]);

    }
    public function carilaporan(Request $request)
    {
      

    }

    public function cetakkeuangan(Request $request)
    {
          date_default_timezone_set('Asia/Jakarta');
        $date = date('d - m - Y');  
        $tahun = $request->tahun;
        $kelascari = $request->kelascari;
                
        $tahun = $request->tahun;
        $pilihkelas = $request->kelas;

         $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

        $kelas = Kelas::all();
        
        if (!empty($tahun)) {
            
         $detailpembayaran = DetailPembayaran::join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
                                            ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas') 
                                            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')                                       
                                            ->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'detailpembayaran.id_pembayaran')
                                            ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
                                            ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                                            ->where('kelas.nama_kelas', '=', $kelascari)
                                            ->get()->groupBy('id_siswa');
       
            } else {

                $detailpembayaran = DetailPembayaran::join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
                                            ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas') 
                                            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')                                       
                                            ->join('pembayaran', 'pembayaran.id_pembayaran', '=', 'detailpembayaran.id_pembayaran')
                                            ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
                                            ->get()->groupBy('id_siswa');

            }

   
        // return view('pages.admin.laporankeuangan.index', [  'tahunajar' => $tahunajar, 'kelas' => $kelas, 'detailpembayaran'=>$detailpembayaran,'tahun' => $tahun, 'kelascari' => $kelascari]);

         $pdf = PDF::loadview('pages.admin.laporankeuangan.cetakkeuangan',[  'tahunajar' => $tahunajar, 'kelas' => $kelas, 'detailpembayaran'=>$detailpembayaran,'tahun' => $tahun, 'kelascari' => $kelascari, 'date' =>$date]);
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
