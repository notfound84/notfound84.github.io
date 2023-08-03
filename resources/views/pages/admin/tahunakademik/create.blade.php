@extends('layouts.admin')
@section('title', 'Data Tahun Akademik')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah Data Tahun Akademik</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ url('data-tahunakademik') }}">Data Tahun Akademik</a></div>
              <div class="breadcrumb-item"><a>Tambah Data Tahun Akademik</a></div>
            </div>
          </div>
         
          <div class="section-body">
            <div class="row">
              <div class="col-xl-7">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ route('data-tahunakademik.index') }}" class="btn btn-primary"> Kembali </a>
                  </div>
                  <div class="card-body p-0">
                    <form action="{{ route('data-tahunakademik.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">TAHUN AKADEMIK</label>
                                <input type="text" name="nama_tahunakademik" class="form-control" value="{{ old('nama_tahunakademik') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">STATUS TAHUN</label>
                                <select name="status" id="status" class="form-control" value="{{ old('status') }}" required>
                                  <option value="">Pilih Salah Satu</option>
                                  <option value="a">aktif</option>
                                  <option value="n">nonaktif</option>
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
