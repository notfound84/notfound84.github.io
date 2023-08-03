@extends('layouts.admin')
@section('title', 'Data Kelas')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Petugas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('data-user.index') }}">Data Petugas</a></div>
                    <div class="breadcrumb-item"><a>Tambah Data Petugas</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('data-user.index') }}" class="btn btn-primary"> Kembali </a>
                            </div>
                            <div class="card-body p-0">
                                <form action="{{ route('data-user.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ old('nama') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <input type="text" name="alamat" class="form-control"
                                                value="{{ old('alamat') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Telephone</label>
                                            <input type="integer" name="telephone" class="form-control"
                                                value="{{ old('telephone') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ old('username') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                value="{{ old('password') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Level</label>
                                            <select name="level" id="" class="form-control"
                                                value="{{ old('level') }}" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="admin">Admin</option>
                                                <option value="Bendahara">Bendahara</option>
                                            </select>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection
