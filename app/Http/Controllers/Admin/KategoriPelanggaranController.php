<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriPelanggaran;
use Alert;
use Illuminate\Support\Facades\Hash;

class KategoriPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoripelanggaran = KategoriPelanggaran::orderBy('nama_pelanggaran', 'asc')->get();
        $kategoripelanggaran = KategoriPelanggaran::paginate(5);

        return view('pages.admin.kategoripelanggaran.index', ['kategoripelanggaran' =>$kategoripelanggaran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.kategoripelanggaran.create');
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
            'nama_pelanggaran' => 'required',
            'poin' => 'required',
            'status'=>'required'
            
        ]);

        if($validasi) :
            $store = KategoriPelanggaran::create([
                'nama_pelanggaran' => $request->nama_pelanggaran,
                'poin' => $request->poin,
                'status' => $request->status
                
            ]);
            if ($store) :
                Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
            endif;
        endif;

        return redirect()->route('kategori-pelanggaran.index');
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
    public function edit($id_katpel)
    {
        $kategoripelanggaran = KategoriPelanggaran::find($id_katpel);

        return view('pages.admin.kategoripelanggaran.edit',[
            'kategoripelanggaran' => $kategoripelanggaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pelanggaran)
    {
        $validasi = $request->validate([
            'nama_pelanggaran' => 'required',
            'poin' => 'required',
            'status' => 'required'
            
        ]);

        if($validasi) :
            $update = KategoriPelanggaran::findOrFail($id_pelanggaran)->update([
                'nama_pelanggaran' => $request->nama_pelanggaran,
                'poin' => $request->poin,
                'status' => $request->status
                
            ]);
            if ($update) :
                Alert::success('Berhasil', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
            endif;
        endif;

        return redirect()->route('kategori-pelanggaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_katpel)
    {
        if (KategoriPelanggaran::find($id_katpel)->delete()) :
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;
         return back();
    }
}
