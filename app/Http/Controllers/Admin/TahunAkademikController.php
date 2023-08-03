<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunakademik = TahunAkademik::orderBy('id_tahunakademik', 'desc')->get();
        $tahunakademik = TahunAkademik::paginate(5);

        return view('pages.admin.tahunakademik.index', ['tahunakademik' =>$tahunakademik]);
    }
    public function caritahun(Request $request)
    {
        $keyword = $request->caritahun;
        $tahunakademik = TahunAkademik::where('nama_tahunakademik', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pages.admin.tahunakademik.index', compact('tahunakademik'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.tahunakademik.create');
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
            'nama_tahunakademik' => 'required',
            'status' => 'required',
        ]);

        $store = TahunAkademik::create([
                'nama_tahunakademik' => $request->nama_tahunakademik,
                'status' => $request->status,
        ]);

            if ($store) :
                Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
            endif;

        return redirect()->route('data-tahunakademik.index');
       
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
    public function edit($id_tahunakademik)
    {
        $tahunakademik = TahunAkademik::find($id_tahunakademik);

        return view('pages.admin.tahunakademik.edit',[
            'tahunakademik' => $tahunakademik
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tahunakademik)
    {
        $tahunakademik = TahunAkademik::findOrFail($id_tahunakademik);
                        $tahunakademik->nama_tahunakademik = $request->input('nama_tahunakademik');
                        $tahunakademik->status = $request->input('status');
      
        $tahunakademik->update();
        if ($tahunakademik) :
            Alert::success('Berhasil', 'Data Berhasil di Edit');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
        endif;

        return redirect()->route('data-tahunakademik.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tahunakademik)
    {
        if (TahunAkademik::find($id_tahunakademik)->delete()) :
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;
         return back();
    }
}
