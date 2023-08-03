@extends('layouts.admin')
@section('title', 'Rincian Pembayaran')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Rincian Pembayaran</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="">Rincian Pembayaran</a></div>
            </div>
          </div>
         
      <div class="card col-12 col-md-6 col-lg-12">
      <div class="card-header">
        <div class="card-header">
                    <h4> <a href="{{ route('data-rincian-pembayaran.create') }}" class="btn btn-primary btn-icon icon-left"><i class="far fa-tabel"></i> Tambah Data</a></h4>
                    <form class="card-header-form"  method="get" action="{{ route('caririncian') }}">
                      <div class="input-group">
                        <input type="text" name="caririncian" class="form-control" id="caririncian" placeholder="Cari Rincian">
                        <div class="input-group-btn">
                          <button  type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
        </div>
      </div>
      
                <div class="card">
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-md">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Pembayaran</th>
                          <th>Nominal</th>
                          <th>Kelas</th>
                          <th>Tahun Akademik</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rincianpembayaran as $i => $rin)
                          <tr>
                              <td>{{ $i + $rincianpembayaran->firstItem() }}</td>
                              <td>{{ $rin -> uraian_pembayaran}} </td>
                              <td>{{ $rin -> nominal}} </td>
                              <td>{{ $rin -> kelas->nama_kelas}} </td>
                              <td>{{ $rin -> tahunakademik->nama_tahunakademik}} </td>
                              <td>{{ $rin -> status}}</td>
                              <td>
                                  <a href="{{ route('data-rincian-pembayaran.edit', $rin->id_rincianpembayaran)}}" class="btn btn-warning">Edit</a>
                                  {{-- <form action="{{ route('data-rincian-pembayaran.destroy', $rin->id_rincianpembayaran) }}" class="d-inline" method="POST" id="delete{{$rin->id_rincianpembayaran}}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-action " data-toggle="tooltip" title="Delete" >Hapus</button>
                                  </form> --}}
                              </td>
                          </tr>

                          @endforeach
                        </tbody>
                      </table>
                      {{ $rincianpembayaran->links() }}
                    </div>
                  </div>
                  </div>
                </div>
    </div>
        </section>
      </div>
</div>
@endsection