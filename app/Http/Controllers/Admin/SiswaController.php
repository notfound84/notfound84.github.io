<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use App\Models\DetailKelas;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
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
        $status_siswa = $request->status_siswa;

        $kelas = Kelas::all();

        $tahunakademik = TahunAkademik::select('nama_tahunakademik')
                                    ->orderBy('nama_tahunakademik', 'desc')->get();

        if (empty($tahun)) {
        
        $siswa = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'siswa.id_tahunakademik')->orderBy('id_siswa', 'asc')->get();

        } else {
        $siswa = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
                        ->join('tahunakademik', 'tahunakademik.id_tahunakademik', '=', 'siswa.id_tahunakademik')
                        ->where('tahunakademik.nama_tahunakademik', '=', $tahun)
                        ->where('kelas.nama_kelas', '=', $kelascari)
                        ->where('siswa.status_siswa', '=', $status_siswa)->orderBy('id_siswa', 'asc')->get();

            
        }
        return view('pages.admin.siswa.index', ['siswa'=>$siswa,'kelas'=>$kelas, 'tahunakademik'=>$tahunakademik]);
        // var_dump($siswa);
    }
    public function carisiswa(Request $request)
    {
        $keyword = $request->carisiswa;
        $siswa = Siswa::where('nisn', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pages.admin.siswa.index', compact('siswa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $tahunakademik = TahunAkademik::all();
        return view('pages.admin.siswa.create', ['kelas'=>$kelas, 'tahunakademik'=>$tahunakademik]);
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
            'nisn' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'id_kelas'=>'required',
            'id_tahunakademik' => 'required',
        ]);
         

        $store = Siswa::create([
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'id_kelas' => $request->id_kelas,
                'id_tahunakademik' => $request->id_tahunakademik,
                'status_siswa' => $request->status_detail,
        ]);


        $store1 = DetailKelas::create([
            'id_siswa'=> $store->id_siswa,
            'id_kelas' => $request->id_kelas,
            'id_tahunakademik'=>$request->id_tahunakademik,
            // 'status_detail'=>$request->status_detail
        ]);

        return redirect()->route('data-siswa.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        $kelas = Kelas::all();
        $tahunakademik = TahunAkademik::all();
        
        return view('pages.admin.siswa.show', ['siswa' => $siswa, 'kelas'=>$kelas, 'tahunakademik'=>$tahunakademik]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        $kelas = Kelas::all();
        $tahunakademik = TahunAkademik::all();

        return view('pages.admin.siswa.edit',['siswa'=>$siswa, 'kelas'=>$kelas, 'tahunakademik'=>$tahunakademik]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_siswa)
    {

        $siswa = Siswa::find($id_siswa);
                $siswa->nisn = $request->input('nisn');
                $siswa->nama = $request->input('nama');
                $siswa->tempat_lahir = $request->input('tempat_lahir');
                $siswa->tgl_lahir = $request->input('tgl_lahir');
                $siswa->jenis_kelamin = $request->input('jenis_kelamin');
                $siswa->alamat = $request->input('alamat');
                $siswa->no_telp = $request->input('no_telp');
                $siswa->nama_ayah = $request->input('nama_ayah');
                $siswa->nama_ibu = $request->input('nama_ibu');
                $siswa->pekerjaan_ayah = $request->input('pekerjaan_ayah');
                $siswa->pekerjaan_ibu = $request->input('pekerjaan_ibu');
                $siswa->id_kelas = $request->input('id_kelas');
                $siswa->id_tahunakademik = $request->input('id_tahunakademik');

        if($request->hasfile('foto'))
        {
            $destination = 'public_path()./img'.$siswa->foto;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('foto');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move(public_path().'/img', $filename);
            $siswa->foto = $filename;
        }
        
        $siswa->update();
        if ($siswa) :
            Alert::success('Berhasil', 'Data Berhasil di Edit');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
        endif;

       return redirect()->route('data-siswa.index');
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
