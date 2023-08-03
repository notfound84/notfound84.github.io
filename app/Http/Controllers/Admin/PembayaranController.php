<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\DetailPembayaran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\RincianPembayaran;
use App\Models\TahunAkademik;
use Alert;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rincianpembayaran = RincianPembayaran::list_rincianpembayaran();
             $request->session()->forget("cart");
            $request->session()->forget("pilihsiswa");
            $request->session()->forget("caritahun");
            $request->session()->forget("carikelas");
        
         return redirect("/cart");

        
    }

    public function tampil(Request $request)
    {
      $tahun = $request->tahun;
      $pilihkelas = $request->kelas;

      // $caritahun = session('caritahun', $tahun);
      // $carikelas = session('carikelas', $pilihkelas);
      $caritahun = session("caritahun");
      $carikelas = session("carikelas");

        $siswa = Siswa::join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'siswa.id_tahunakademik')
                        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
                        ->where('kelas.nama_kelas', '=', $pilihkelas)
                        ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                        ->orderBy('nisn', 'asc')->get();
       
        $request->session()->forget("pilihsiswa");

        return view('pages.admin.pembayaran.tampil',['siswa' =>$siswa, 'tahun' => $tahun, 'pilihkelas' => $pilihkelas, 'caritahun' => $caritahun ,'carikelas' => $carikelas]);

        // return view('pages.admin.pembayaran.tampil',['siswa' =>$siswa, 'tahun' => $tahun, 'pilihkelas' => $pilihkelas]);

      // var_dump($carikelas);
       
    }

    public function cekpembayaran(Request $request)
    {
       $nisn = $request->nisn;
        $tahun = $request->tahun;
        date_default_timezone_set('Asia/Jakarta');
        

            $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->where('status', '=', 'a')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

              // $datasiswa = Siswa::detail_siswa($nisn);
              if(!empty($nisn)) {
              

              $pembayaran = Pembayaran::selectRaw('pembayaran.id_pembayaran, pembayaran.tgl_pembayaran, pembayaran.total_pembayaran, siswa.nisn, siswa.nama as nama_siswa, kelas.nama_kelas, detailpembayaran.id_detailpembayaran, rincianpembayaran.id_rincianpembayaran, rincianpembayaran.uraian_pembayaran, rincianpembayaran.nominal, tahunakademik.nama_tahunakademik, petugas.nama as nama_petugas')

              ->join('detailpembayaran', 'detailpembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')

              ->join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
              
              ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')
              ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
              ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas')
              
              ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')

                ->where('siswa.nisn', '=', $nisn)
                ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                                  ->orderBy('tgl_pembayaran', 'desc')->get()->groupBy('id_pembayaran');

                    if ($pembayaran->isEmpty()) {
                          Alert::error('Terjadi Kesalahan','NISN : '. $nisn . ' Tidak Ditemukan / Belum Ada Pembayaran Pada Tahun Akademik ' . $tahun);  
                    } else {


             
                    return view('pages.admin.pembayaran.cekpembayaran',['tahunajar' =>$tahunajar,'pembayaran' =>$pembayaran,'nisn' =>$nisn,'tahun' => $tahun]);
                    }
               }

            return view('pages.admin.pembayaran.cekpembayaran',['tahunajar' =>$tahunajar]);
       

  
    }



    public function store(Request $request)
    {

        $cart = session("cart");
        $pilihsiswa = session("pilihsiswa");
        date_default_timezone_set('Asia/Jakarta');
        // $date = date('d-m-Y');
        //Tanggal Sekarang
        $date = Carbon::now();

        $total =0;

        foreach ($cart as $crt ) {
          $total+=$crt['nominal'];
        }


          foreach ($pilihsiswa as $sis) {
            $store = Pembayaran::create([
                      'id_siswa' => $sis['id_siswa'],
                      'tgl_pembayaran' => $date,
                      'total_pembayaran' => $total,
                      'id_petugas' => $sis['id_petugas']

                    ]);
          }


          foreach ($cart as $cr ) {
                 $store2 = DetailPembayaran::create([
                    'id_pembayaran' => $store->id_pembayaran,
                    'id_rincianpembayaran' => $cr['id_rincianpembayaran']
       
                    ]);
                      
               }
                         if ($store2) :
                            Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
                         else :
                            Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
                         endif;
                     

            $request->session()->forget("cart");
            $request->session()->forget("pilihsiswa");
            $request->session()->forget("caritahun");
            $request->session()->forget("carikelas");

            return redirect("/cart");
        


        
    }

    public function carinisn(Request $request)
    {
        $keyword = $request->carinisn;
        $siswa = Siswa::where('nisn', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pages.admin.pembayaran.tampil', compact('siswa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function pilihsiswa($nisn)
    {
        $pilihsiswa = session("pilihsiswa");

        $caritahun = Session()->get('caritahun');
        $carikelas = Session()->get('carikelas'); 

        $datasiswa = Siswa::detail_siswa($nisn);
       $pilihsiswa[$nisn] = [
        'id_siswa' => $datasiswa->id_siswa,
        'nisn' => $datasiswa->nisn,
        'id_petugas' => Auth::user()->id_petugas,
        'nama' => $datasiswa->nama,
        'nama_kelas' => $datasiswa->kelas->nama_kelas,
       ];

       session(["pilihsiswa" => $pilihsiswa]);
       session(["carikelas" => $carikelas]);
       session(["caritahun" => $caritahun]);



       // var_dump($carikelas);
       // return redirect()->back();
        return redirect("/cart");
    }

    public function do_tambah_cart($id_rincianpembayaran)
    {
       $cart = session("cart");

        $caritahun = Session()->get('caritahun');
        $carikelas = Session()->get('carikelas'); 

       $produk = RincianPembayaran::detail_rincianpembayaran($id_rincianpembayaran);
       $cart[$id_rincianpembayaran] = [
        'id_rincianpembayaran' => $produk->id_rincianpembayaran,
        'uraian_pembayaran' => $produk->uraian_pembayaran,
        'nominal' => $produk->nominal,
        'id_kelas' => $produk->id_kelas,
        'id_tahunakademik' => $produk->id_tahunakademik,
        'nama_tahunakademik' => $produk->nama_tahunakademik
       ];

       session(["cart" => $cart]);

       // return redirect("/cart");
       return redirect()->back();

       // return redirect("/cart");
      
                
    }

    function caritahunkelas(Request $request){
      $tahun = $request->tahun;
      $pilihkelas = $request->kelas;
        $caritahun = session()->put('caritahun', $tahun);
        $carikelas = session()->put('carikelas', $pilihkelas);

        return redirect()->back();

    }

    function cart(Request $request){

         $tahun = session("caritahun");
        $pilihkelas = session("carikelas");

        // $caritahun = session()->put('caritahun', $tahun);
        // $carikelas = session()->put('carikelas', $pilihkelas);

        $cart = session("cart");
        $pilihsiswa = session("pilihsiswa");

        $caritahun = session("caritahun");
        $carikelas = session("carikelas");


         $tahunajar = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

        $kelas = Kelas::all();

        //cari tahun akademik teratas dan aktif
        $tahunnow = TahunAkademik::select('nama_tahunakademik')
                                  ->where('status', '=', 'a')
                                  ->orderBy('nama_tahunakademik', 'desc')->first();
     

        $rincianpembayaran = RincianPembayaran::join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas')
            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')
            ->where('tahunakademik.nama_tahunakademik', '=', $tahunnow->nama_tahunakademik)
            ->where('tahunakademik.status', '=', 'a')
            ->orderBy('kelas.nama_kelas', 'asc')->get();

              

        if(!(empty($tahun))){

            $rincianpembayaran = RincianPembayaran::join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas')
            ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')

            ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
            ->where('kelas.nama_kelas', '=', $pilihkelas)
            ->where('tahunakademik.status', '=', 'a')->get();

                return view('pages.admin.pembayaran.index',['rincianpembayaran' =>$rincianpembayaran, 'cart' => $cart, 'pilihsiswa' => $pilihsiswa, 'tahunajar' => $tahunajar, 'kelas' => $kelas, 'tahun' => $tahun, 'pilihkelas' => $pilihkelas,'caritahun' => $caritahun ,'carikelas' => $carikelas ]);

        }

       

         return view('pages.admin.pembayaran.index',['rincianpembayaran' =>$rincianpembayaran, 'cart' => $cart, 'pilihsiswa' => $pilihsiswa, 'tahunajar' => $tahunajar, 'kelas' => $kelas, 'tahun' => $tahun, 'pilihkelas' => $pilihkelas, 'caritahun' => $caritahun ,'carikelas' => $carikelas]);

        
    }
    function do_hapus_cart($id_rincianpembayaran){
        
        $cart = Session()->get('cart');
        $caritahun = Session()->get('caritahun');
        $carikelas = Session()->get('carikelas'); 
        // $itemDelete=$cart[$id]['id'];
        // dd($itemDelete);
        unset($cart[$id_rincianpembayaran]);
        session()->put('cart', $cart);
        if (count($cart)==0) {
            session()->forget('cart');

        }

        return redirect()->back();
    }
  //   function cetak( Request $request){
  //       date_default_timezone_set('Asia/Jakarta');
  //     $date = date('d - m - Y');
  //     $nisn = $request->nisn;
  //     $tahun = $request->tahun;

  //         $pembayaran = Pembayaran::selectRaw('pembayaran.id_pembayaran, pembayaran.tgl_pembayaran, pembayaran.total_pembayaran, siswa.nisn, siswa.nama as nama_siswa, kelas.nama_kelas, detailpembayaran.id_detailpembayaran, rincianpembayaran.id_rincianpembayaran, rincianpembayaran.uraian_pembayaran, rincianpembayaran.nominal, tahunakademik.nama_tahunakademik, petugas.nama as nama_petugas')

  //             ->join('detailpembayaran', 'detailpembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')

  //             ->join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
              
  //             ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')
  //             ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
  //             ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas')
              
  //             ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')

  //               ->where('siswa.nisn', '=', $nisn)
  //               ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
  //                                 ->orderBy('tgl_pembayaran', 'desc')->get()->groupBy('id_pembayaran');


  //         $pdf = PDF::loadview('pages.admin.pembayaran.cetak',['pembayaran' =>$pembayaran,'date' =>$date]);
  //         return $pdf->stream();
      
  // }
  function cetaksemua(Request $request){
        
      date_default_timezone_set('Asia/Jakarta');
      $date = date('d - m - Y');
      $nisn = $request->nisn;
      $tahun = $request->tahun;

          $pembayaran = Pembayaran::selectRaw('pembayaran.id_pembayaran, pembayaran.tgl_pembayaran, pembayaran.total_pembayaran, siswa.nisn, siswa.nama as nama_siswa, kelas.nama_kelas, detailpembayaran.id_detailpembayaran, rincianpembayaran.id_rincianpembayaran, rincianpembayaran.uraian_pembayaran, rincianpembayaran.nominal, tahunakademik.nama_tahunakademik, petugas.nama as nama_petugas')

              ->join('detailpembayaran', 'detailpembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')

              ->join('rincianpembayaran', 'rincianpembayaran.id_rincianpembayaran', '=', 'detailpembayaran.id_rincianpembayaran')
              
              ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'rincianpembayaran.id_tahunakademik')
              ->join('siswa', 'siswa.id_siswa', '=', 'pembayaran.id_siswa')
              ->join('kelas', 'kelas.id_kelas', '=', 'rincianpembayaran.id_kelas')
              
              ->join('petugas', 'petugas.id_petugas', '=', 'pembayaran.id_petugas')

                ->where('siswa.nisn', '=', $nisn)
                ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                                  ->orderBy('tgl_pembayaran', 'desc')->get()->groupBy('id_pembayaran');


          $pdf = PDF::loadview('pages.admin.pembayaran.cetaksemua',['pembayaran' =>$pembayaran,'date' =>$date]);
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
    // public function store(Request $request)
    // {
    //     $validasi = $request->validate([
    //         'uraian_pembayaran' => 'required',
    //         'nominal' => 'required',
    //         'tahun_ajaran' => 'required',
    //         'id_kelas' => 'required'
            
    //     ]);

    //     if($validasi) :
    //         $store = Keranjang::create([
    //             'k_uraian_pembayaran' => $request->uraian_pembayaran,
    //             'k_nominal' => $request->nominal,
    //             'k_tahun_ajaran' => $request->tahun_ajaran,
    //             'id_kelas' => $request->id_kelas,
                
    //         ]);
    //         if ($store) :
    //             Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
    //         else :
    //             Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
    //         endif;
    //     endif;

    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($no_pembayaran)
    {
        $pembayaran = Pembayaran::find($no_pembayaran);
        $rincianpembayaran = RincianPembayaran::list_rincianpembayaran();

        
        return view('pages.admin.pembayaran.edit',[
            'pembayaran' => $pembayaran, 'rincianpembayaran'=> $rincianpembayaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_pembayaran)
    {
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
