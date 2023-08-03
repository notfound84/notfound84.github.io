<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RincianPembayaran;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;

class RincianPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rincianpembayaran = RincianPembayaran::orderBy('id_rincianpembayaran', 'asc')->get();
        $rincianpembayaran = RincianPembayaran::paginate(5);

        return view('pages.admin.rincian.index',['rincianpembayaran' =>$rincianpembayaran]);
    }

    public function caririncian(Request $request)
    {
        $keyword = $request->caririncian;
        $rincianpembayaran = RincianPembayaran::where('uraian_pembayaran', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pages.admin.rincian.index', compact('rincianpembayaran'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        return view('pages.admin.rincian.create', [
            'kelas' => $kelas, 'tahunakademik'=>$tahunakademik
        ]);
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
            'uraian_pembayaran' => 'required',
            'nominal' => 'required|numeric',
            'id_kelas' => 'required',
            'id_tahunakademik' => 'required',
            'status' => 'required'
        ]);

        if($validasi) :
            $store = RincianPembayaran::create([
                'uraian_pembayaran' => $request->uraian_pembayaran,
                'nominal' => $request->nominal,
                'id_kelas' => $request->id_kelas,
                'id_tahunakademik' => $request->id_tahunakademik,
                'status' => $request->status
            ]);
            if ($store) :
                Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
            endif;
        endif;

        return redirect()->route('data-rincian-pembayaran.index');
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
    public function edit($id_rincianpembayaran)
    {
        $rincianpembayaran = RincianPembayaran::find($id_rincianpembayaran);
        $kelas = Kelas::all();
        $tahunakademik = TahunAkademik::all();


        return view('pages.admin.rincian.edit',[
            'rincianpembayaran' => $rincianpembayaran,
            'kelas'=>$kelas,
            'tahunakademik'=>$tahunakademik
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_rincianpembayaran)
    {
        $validasi = $request->validate([
            'uraian_pembayaran' => 'required',
            'nominal' => 'required|numeric',
            'id_kelas' => 'required',
            'id_tahunakademik' => 'required',
            'status' => 'required',
            
        ]);

        if($validasi) :
            $update = RincianPembayaran::findOrFail($id_rincianpembayaran)->update([
                'uraian_pembayaran' => $request->uraian_pembayaran,
                'nominal' => $request->nominal,
                'id_kelas' => $request->id_kelas,
                'id_tahunakademik' => $request->id_tahunakademik,
                'status' => $request->status,

            ]);
            if ($update) :
                Alert::success('Berhasil', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
            endif;
        endif;

       return redirect()->route('data-rincian-pembayaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_rincianpembayaran)
    {
        if (RincianPembayaran::find($id_rincianpembayaran)->delete()) :
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;
         return back();
    }
}
