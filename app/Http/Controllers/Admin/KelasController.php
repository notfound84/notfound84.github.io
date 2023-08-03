<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\DetailKelas;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'desc')->get();
        $kelas = Kelas::paginate(5);

        return view('pages.admin.kelas.index', ['kelas' =>$kelas]);
    }

    public function carikelas(Request $request)
    {
        $keyword = $request->carikelas;
        $kelas = Kelas::where('nama_kelas', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pages.admin.kelas.index', compact('kelas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function detailkelas(Request $request)
    {
        $tahun = $request->tahun;
        $carikelas = $request->kelas;
        $status_siswa = $request->status_siswa;

        $detailkelas = DetailKelas::join('siswa', 'siswa.id_siswa', '=', 'detailkelas.id_siswa')
                                ->join('kelas', 'kelas.id_kelas', '=', 'detailkelas.id_kelas')
                                ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'detailkelas.id_tahunakademik')
                                ->orderBy('tahunakademik.nama_tahunakademik', 'desc')
                                ->orderBy('id_detail_kelas', 'asc')
                                // ->orderBy('status_detail', 'desc')
                                ->get();

        $siswa = Siswa::all();
        $kelas = Kelas::all();

        $tahunakademik = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

        $akademikselanjutnya = TahunAkademik::orderBy('nama_tahunakademik', 'desc')->get();


        if(!empty($tahun)) {

               $detailkelas = DetailKelas::join('siswa', 'siswa.id_siswa', '=', 'detailkelas.id_siswa')
                                ->join('kelas', 'kelas.id_kelas', '=', 'detailkelas.id_kelas')
                                ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'detailkelas.id_tahunakademik')
                                ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                                ->where('kelas.nama_kelas', '=', $carikelas)
                                ->where('siswa.status_siswa', '=', $status_siswa)
                                ->orderBy('tahunakademik.nama_tahunakademik', 'desc')->get();

                    if ($detailkelas->isEmpty()) {

                          Alert::error('Terjadi Kesalahan', 'Data Tidak Ditemukan Untuk Tahun ' . $tahun . ' dan Kelas ' . $carikelas);  

                    } else {

                     return view('pages.admin.kelas.detailkelas',['detailkelas' =>$detailkelas, 'siswa'=>$siswa, 'kelas'=> $kelas, 'tahunakademik' => $tahunakademik, 'akademikselanjutnya' => $akademikselanjutnya,'status_siswa' => $status_siswa]);
                        // var_dump($tahun);
                    }
               }



        return view('pages.admin.kelas.detailkelas',['detailkelas' =>$detailkelas, 'siswa'=>$siswa, 'kelas'=> $kelas, 'tahunakademik' => $tahunakademik, 'akademikselanjutnya' => $akademikselanjutnya,'status_siswa' => $status_siswa]);
    
    }

    public function naikkelas(Request $request){

        $idkelas = $request->status;
        $idsiswa = $request->id_siswa;
        $lulus = $request->lulus;

        $detailsiswattambah = [];
        $tahuntujuan = $request->tahun;
        $kelastujuan = $request->kelastujuan;

 if(!empty($idkelas)){

        foreach ($idkelas as $key) {
           
        $detailsiswattambah = DetailKelas::select('id_siswa')->where('id_detail_kelas', '=', $key)->first();
             $idsiswatambah[$key] = [
                'id_siswa' => $detailsiswattambah->id_siswa
               ];

       // var_dump($ada);
            
        }

      
            foreach ($idkelas as $key => $id_kelasupdet) {

                    $detailkelas = DetailKelas::findOrFail($id_kelasupdet);
                            $detailkelas->status_detail = 'n';
                          
                    $detailkelas->update();
                }

            foreach ($idsiswatambah as $key) {

                if ($kelastujuan == 'lulus') {
                    $siswa = siswa::findOrFail($key['id_siswa']);
                        $siswa->status_siswa = 'n';
                        // $siswa->id_tahunakademik = $tahuntujuan;
                      
                $siswa->update();
    

                } else {
                $siswa = siswa::findOrFail($key['id_siswa']);
                        $siswa->id_kelas = $kelastujuan;
                        $siswa->id_tahunakademik = $tahuntujuan;
                      
                $siswa->update();
                  
                $tambahdetailkelas = DetailKelas::create([
                'id_siswa' => $key['id_siswa'],
                'id_kelas' => $kelastujuan,
                'id_tahunakademik' => $tahuntujuan,
                'status_detail' => 'a'
                
            ]);
            if ($tambahdetailkelas OR $siswa) :
                Alert::success('Berhasil', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
            endif;

           return redirect()->route('detailkelas');
                }

            }
        } else {
             
            Alert::error('Terjadi Kesalahan', 'Pilih Siswa Yang Akan di Edit');


        }

   return redirect()->route('detailkelas');
        // var_dump($ada);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_kelas' => 'required',
            'status' => 'required',
            
        ]);

        if($validasi) :
            $store = Kelas::create([
                'nama_kelas' => $request->nama_kelas,
                'status' => $request->status
                
            ]);
            if ($store) :
                Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
            endif;
        endif;

        return redirect()->route('data-kelas.index');
                
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
    public function edit($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);

        return view('pages.admin.kelas.edit',[
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
                $kelas->nama_kelas = $request->input('nama_kelas');
                $kelas->status = $request->input('status');
              
        $kelas->update();
        if ($kelas) :
            Alert::success('Berhasil', 'Data Berhasil di Edit');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
        endif;

       return redirect()->route('data-kelas.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelas)
    {
        if (Kelas::find($id_kelas)->delete()) :
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;
         return back();
    }
}
