<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggaran;
use App\Models\DetailPelanggaran;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\KategoriPelanggaran;
use App\Models\User;

class CekPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $tahun = $request->tahun;
        $nisna = $request->nisna;
        // $pelanggaran = Pelanggaran::all();
        // $siswa = Siswa::all();
        // $kategoripelanggaran = DetailPelanggaran::all();
        // $user = User::all();
        // $total = 0;
         $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();


         //    if (!empty($nisn)) {

         //    $pelanggaran = Pelanggaran::join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
         //                            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
         //                            ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'pelanggaran.id_pelanggaran')
         //                            ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
         //                            ->where('siswa.nisn', '=', $nisna)
         //                            ->where('tahunakademik.nama_tahunakademik', '=', $tahun)->get()->dd();

                 

                   
         // return view('pages.admin.cekpelanggaran.index',['pelanggaran' =>$pelanggaran,'tahunajar' =>$tahunajar,'tahunajar' =>$tahunajar, '$nisna' => $nisna]);
                    
         //     }
       

         return view('pages.admin.cekpelanggaran.index',['tahunajar' =>$tahunajar, '$tahun' => $tahun]);
            // var_dump($nisna);

    }
    public function caripelanggaran(Request $request)
    {
        
         $tahun = $request->tahun;
        $nisna = $request->nisna;
        // $pelanggaran = Pelanggaran::all();
        // $siswa = Siswa::all();
        // $kategoripelanggaran = DetailPelanggaran::all();
        // $user = User::all();
        // $total = 0;
         $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();


            $pelanggaran = Pelanggaran::join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                                    ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                                    ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'pelanggaran.id_pelanggaran')
                                    ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                                    ->where('siswa.nisn', '=', $nisna)
                                    ->where('tahunakademik.nama_tahunakademik', '=', $tahun)->get();

                
                   
         return view('pages.admin.cekpelanggaran.index',['pelanggaran' =>$pelanggaran,'tahunajar' =>$tahunajar,'tahunajar' =>$tahunajar, '$nisna' => $nisna]);
                                    // var_dump($pelanggaran);
                    
         

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
