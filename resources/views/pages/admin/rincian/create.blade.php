@extends('layouts.admin')
@section('title', 'Tambah Rincian Pembayaran')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah Rincian Pembayaran</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ url('data-rincian-pembayaran')}}">Rincian Pembayaran</a></div>
              <div class="breadcrumb-item"><a href="#">Tambah Rincian Pembayaran</a></div>
            </div>
          </div>
         
          <div class="section-body">
            <div class="row">
              <div class="col-xl-7">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ url('data-rincian-pembayaran')}}" class="btn btn-primary"> Kembali </a>
                  </div>
                  <div class="card-body p-0">
                    <form action="{{ route('data-rincian-pembayaran.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Pembayaran</label>
                                <input type="text" name="uraian_pembayaran" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nominal</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      Rp.
                                    </div>
                                  </div>
                                  <input type="text" name="nominal" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">KELAS</label>
                                <select name="id_kelas" id="" class="custom-select"{{ count($kelas) == 0 ? 'disabled' : ''}}> 
                                  @if(count($kelas) == 0)
                                  <option value="">Pilihan tidak ada</option>
                                  @else
                                  <option value="">Silahkan Pilih</option>
                                      @foreach ($kelas as $kls)
                                      <option value="{{ $kls->id_kelas}}">{{$kls->nama_kelas}}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">TAHUN AKADEMIK</label>
                                <select name="id_tahunakademik" id="" class="form-control" value="{{ old('id_tahunakademik') }}" required>
                                  <option value="">Pilih Salah Satu</option>
                                     @foreach($tahunakademik as $thn => $th)
                                    <option value="{{$th->id_tahunakademik}}">{{$th->nama_tahunakademik}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">STATUS</label>
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
