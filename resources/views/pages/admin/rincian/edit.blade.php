@extends('layouts.admin')
@section('title', 'Edit Data Rincian')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit Data Rincian Pembayaran</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ url('data-rincian-pembayaran') }}">Rincian Pembayaran</a></div>
              <div class="breadcrumb-item"><a href="#">Edit Data Rincian Pembayaran</a></div>
            </div>
          </div>
         
          <div class="section-body">
            <div class="row">
              <div class="col-xl-7">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ route('data-rincian-pembayaran.index') }}" class="btn btn-primary"> Kembali </a>
                  </div>
                  <div class="card-body p-0">
                    <form action="{{ route('data-rincian-pembayaran.update', $rincianpembayaran->id_rincianpembayaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Pembayaran</label>
                                <input type="text" name="uraian_pembayaran" class="form-control" value="{{ $rincianpembayaran->uraian_pembayaran}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nominal</label>
                                <input type="text" name="nominal" class="form-control" value="{{ $rincianpembayaran->nominal}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">KELAS</label>
                                <select name="id_kelas" id="" class="form-control" value="{{ old('id_kelas') }}" required>
                                  <option value="{{ $rincianpembayaran->id_kelas}}">{{ $rincianpembayaran->kelas->nama_kelas}}</option>
                                     @foreach($kelas as $kel => $k)
                                    <option value="{{$k->id_kelas}}">{{$k->nama_kelas}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">TAHUN AKADEMIK</label>
                                <select name="id_tahunakademik" id="" class="form-control" value="{{ old('id_tahunakademik') }}" required>
                                  <option value="{{ $rincianpembayaran->id_tahunakademik}}">{{ $rincianpembayaran->tahunakademik->nama_tahunakademik}}</option>
                                     @foreach($tahunakademik as $thn => $th)
                                    <option value="{{$th->id_tahunakademik}}">{{$th->nama_tahunakademik}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">STATUS</label>
                                <select name="status" id="status" class="form-control" value="{{ old('status') }}" required>
                                  <option value="{{ $rincianpembayaran->status}}">{{ $rincianpembayaran->status}}</option>
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
