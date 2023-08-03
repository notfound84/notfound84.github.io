<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('id_petugas', 'desc')->get();

        return view('pages.admin.user.index', ['user' => $user]);
    }
    public function cariuser(Request $request)
    {
        $keyword = $request->cariuser;
        $user = User::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pages.admin.user.index', compact('user'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $store = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telephone' => $request->telephone,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => $request->level,
            'remember_token' => Str::random(60),
        ]);

        if ($store) :
            Alert::success('Berhasil', 'Data Berhasil di Tambahkan');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Tambahkan');
        endif;
        return redirect()->route('data-user.index');
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
    public function edit($id_petugas)
    {
        $petugas = User::find($id_petugas);

        return view('pages.admin.user.edit', [
            'petugas' => $petugas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_petugas)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telephone' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'

        ]);

        if ($validasi) :
            $update = User::findOrFail($id_petugas)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telephone' => $request->telephone,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'level' => $request->level,
                'remember_token' => Str::random(60),

            ]);
            if ($update) :
                Alert::success('Berhasil', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
            endif;
        endif;

        return redirect()->route('data-user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_petugas)
    {
        if (User::find($id_petugas)->delete()) :
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;
        return back();
    }
}
