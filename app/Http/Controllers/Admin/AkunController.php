<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use Session;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.akun.index');
    }
    public function gantipassword()
    {
        return view('pages.admin.akun.gantipassword');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
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
    public function update(Request $request, $id_petugas)
    {

        $validasi = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telephone' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        if ($validasi) :
            $update = User::findOrFail($id_petugas)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telephone' => $request->telephone,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'remember_token' => Str::random(60),

            ]);
            if ($update) :
                Alert::success('Berhasil', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan', 'Data Gagal di Edit');
            endif;
        endif;

        return view('pages.admin.akun.index');
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
