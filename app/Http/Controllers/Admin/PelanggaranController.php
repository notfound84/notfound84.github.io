<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use App\Models\DetailPelanggaran;
use App\Models\KategoriPelanggaran;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Alert;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $tahun = $request->tahun;
            $kelascari = $request->kelas;

            $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

            $kelas = Kelas::all();

            if (empty($tahun)) {
             

        $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();
        return view('pages.admin.pelanggaran.index',['pelanggaran'=>$pelanggaran,'kelas'=>$kelas,'tahunajar'=>$tahunajar]);

            } else {

        $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                        ->where('kelas.nama_kelas', '=', $kelascari)
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();

        return view('pages.admin.pelanggaran.index',['pelanggaran'=>$pelanggaran,'kelas'=>$kelas,'tahunajar'=>$tahunajar]);
            }

        
    }
   

     public function tampilsiswa(Request $request)
    {
        $siswa = Siswa::orderBy('nisn', 'asc')->get();
        $siswa = Siswa::paginate(10);
        $kelas = Kelas::all();
        

        $request->session()->forget("pilihsiswa");

        return view('pages.admin.pelanggaran.tampilsiswa',['siswa' =>$siswa, 'kelas'=>$kelas]);

       
    }

    public function pilih_siswa($nisn)
    {
        $pilihsiswa = session("pilihsiswa");

        $datasiswa = Siswa::detail_siswa($nisn);
       $pilihsiswa[$nisn] = [
        'id_siswa' => $datasiswa->id_siswa,
        'id_tahunakademik' => $datasiswa->id_tahunakademik,
        'id_kelas' => $datasiswa->id_kelas,
        'nisn' => $datasiswa->nisn,
        'id_petugas' => Auth::user()->id_petugas,
        'nama' => $datasiswa->nama,
        'nama_kelas' => $datasiswa->kelas->nama_kelas,
       ];
       session(["pilihsiswa" => $pilihsiswa]);

       // var_dump($datasiswa);

        return redirect("/pelanggaran/create");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $pilihsiswa = session("pilihsiswa");
        $kategoripelanggaran = KategoriPelanggaran::all();
        $user = User::all();
        return view('pages.admin.pelanggaran.create', [
            'kategoripelanggaran' => $kategoripelanggaran,
            'user'=> $user,
            'pilihsiswa'=> $pilihsiswa
        ]);
    }

    public function cekpelanggaran(Request $request){
        $tahun = $request->tahun;
            $nisncari = $request->nisn;

            $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();



            if (empty($tahun)) {
           
        return view('pages.admin.pelanggaran.cekpelanggaran',['tahunajar'=>$tahunajar]);

            } else {

        $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran, kategoripelanggaran.poin,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                        ->where('siswa.nisn', '=', $nisncari)
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();

                if ($pelanggaran->isEmpty()) {
                    Alert::error('Terjadi Kesalahan','NISN : '. $nisncari . ' Tidak Ditemukan / Belum Ada Pelanggaran Pada Tahun Akademik ' . $tahun);  

                }else{

        return view('pages.admin.pelanggaran.cekpelanggaran',['pelanggaran'=>$pelanggaran,'nisncari'=>$nisncari,'tahun'=>$tahun,'tahunajar'=>$tahunajar]);
                }

            }
            return view('pages.admin.pelanggaran.cekpelanggaran',['tahunajar'=>$tahunajar]);
    }

    function cetakrincianpelanggaran(Request $request){
        
      date_default_timezone_set('Asia/Jakarta');
      $date = date('d - m - Y');
      $nisncari = $request->nisn;
      $tahun = $request->tahun;

           $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik,DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.nama_pelanggaran, kategoripelanggaran.poin,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')
                        ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                        ->where('siswa.nisn', '=', $nisncari)
                        ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();


          $pdf = PDF::loadview('pages.admin.pelanggaran.cetakrincianpelanggaran',['pelanggaran' =>$pelanggaran,'date' =>$date]);
          return $pdf->stream();
} 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $pilihsiswa = session("pilihsiswa");
        date_default_timezone_set('Asia/Jakarta');
        // $date = date('d-m-Y');
        //Tanggal Sekarang
        $date = date('Y-m-d') ;

        $validasi = $request->validate([
          
            'id_katpel'=>'required',
            'keterangan'=>'required',
            
        ]);

        if($validasi) :

            foreach ($pilihsiswa as $sis) {
            $store = Pelanggaran::create([
                      'id_siswa' => $sis['id_siswa'],
                      'id_tahunakademik' => $sis['id_tahunakademik'],
                      'id_petugas' => $sis['id_petugas'],
                      'id_kelas' => $sis['id_kelas'],
                      'tgl_pelanggaran' => $date

                    ]);

            $store1 = DetailPelanggaran::create([
                'id_pelanggaran' => $store->id_pelanggaran,
                'id_katpel'=>$request->id_katpel,
                'keterangan'=>$request->keterangan
                
                
            ]);
          }
            
            if ($store1) :
                Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
            endif;
        endif;

            $request->session()->forget("pilihsiswa");
        return redirect()->route('pelanggaran.index');
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
    public function edit($id_detailpelanggaran)
    {
        $pelanggaran = Pelanggaran::selectRaw('pelanggaran.id_pelanggaran,pelanggaran.tgl_pelanggaran,siswa.nisn, siswa.nama, kelas.nama_kelas, tahunakademik.nama_tahunakademik, DetailPelanggaran.id_detailpelanggaran,DetailPelanggaran.keterangan as detail_keterangan, kategoripelanggaran.id_katpel as kate_id_katpel,kategoripelanggaran.nama_pelanggaran,petugas.nama as nama_petugas')
                        ->join('DetailPelanggaran', 'DetailPelanggaran.id_pelanggaran', '=', 'Pelanggaran.id_pelanggaran')
                        ->join('siswa', 'siswa.id_siswa', '=', 'pelanggaran.id_siswa')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'pelanggaran.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', 'pelanggaran.id_kelas')
                        ->join('petugas', 'petugas.id_petugas', '=', 'pelanggaran.id_petugas')
                        ->join('kategoripelanggaran', 'kategoripelanggaran.id_katpel', '=', 'DetailPelanggaran.id_katpel')->where('DetailPelanggaran.id_detailpelanggaran', '=', $id_detailpelanggaran)->get()->first();
        // $pelanggaran = Pelanggaran::find($id_pelanggaran);

        $kategoripelanggaran = KategoriPelanggaran::all();
        //  $siswa = Siswa::all();
        // $user = User::all();
        // $DetailPelanggaran = DetailPelanggaran::all();

        return view('pages.admin.pelanggaran.edit',[
            'pelanggaran' => $pelanggaran,'kategoripelanggaran' => $kategoripelanggaran]);
            // var_dump($pelanggaran);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_detailpelanggaran)
    {
         $DetailPelanggaran = DetailPelanggaran::findOrFail($id_detailpelanggaran);
                $DetailPelanggaran->id_katpel = $request->input('id_katpel');
                $DetailPelanggaran->keterangan = $request->input('keterangan');
              
        $DetailPelanggaran->update();
        if ($DetailPelanggaran) :
            Alert::success('Berhasil', 'Data Berhasil di Edit');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
        endif;

        return redirect()->route('pelanggaran.index');
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
