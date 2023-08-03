@extends('layouts.admin')
@section('title', 'Edit Pembayaran')

@section('content')


<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pembayaran</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Edit Pembayaran</div>
            </div>
          </div>
          <div class="">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-5">
                <div class="card card-primary">
                  <div class="card-header" style="margin-right: 30px">
                    <h4 style="">Edit Pembayaran</h4>
                    <a href="{{ route('tampil') }}" class="btn btn-icon icon-left btn-primary" style="margin-right: 10px" name="tampil" id="tampil"><i class="far fa-user"></i>Cari Siswa</a>
                  
                  </div>
                   @if(empty($pilihsiswa) || count($pilihsiswa) ==0)
                        
                            <div style="margin: 10px;" class="alert alert-danger">
                            <b>Note!</b> Belum ada data yang dipilih !
                            </div>
                        
                        <div class="card-body">
                            <div class="form-group">
                              <label>NISN</label>
                              <label type="text" name="name" class="form-control"></label>
                            </div>
                            <div class="form-group">
                              <label>Nama</label>
                              <label type="text" name="name" value="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                              <label>Kelas</label>
                              <label type="text" name="name" class="form-control"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                    @else
                  @foreach($pilihsiswa as $ds => $dss)
                   <form action="{{ route('data-pembayaran.update', $pembayaran->no_pembayaran) }}" method="POST" enctype="multipart/form-data">
                   @csrf
                   @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label>NISN</label>
                      <input type="text" name="nisn" class="form-control" value="{{ $pembayaran->nisn}}" required>
                    </div>
                    <div class="form-group">
                      <label>Nama</label>
                      <label type="text" name="name" value="" class="form-control">{{$dss["nama"]}}</label>
                    </div>
                    <div class="form-group">
                      <label>Kelas</label>
                      <label type="text" name="name" class="form-control">{{$dss["nama_kelas"]}}</label>
                      <br>
                      <h4><button class="btn btn-icon icon-left btn-success"><i class="fa fa-money-bill"></i> Simpan Pembayaran</button></h4>
                    </div>
                  </div>
                </div>
              </div>
            </form>
             @endforeach
             @endif
              <div class="col-12 col-md-7 col-lg-7">
                <div class="card card-warning">
                  <div class="card-header">
                    <h4>Keranjang</h4>
                  </div>
                  <div class="card-body">
                    @if(empty($cart) || count($cart) ==0)
                        
                            <div class="alert alert-danger">
                            <b>Note!</b> Belum ada transaksi pembayaran.
                            </div>
                        </div>
                    @else
                    <div class="table-responsive">
                    <table class="table table-striped" id="pembayaranTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Pembayaran</th>
                        <th>Biaya</th>
                        <th>Tahun</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                      $no=1;
                      $total=0;
                      ?>
                      @foreach($cart as $ct => $val)
                      <?php
                      $totalsemua = $val["nominal"];
                      ?>
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$val["uraian_pembayaran"]}}</td>
                            <td>{{$val["nominal"]}}</td>
                            <td>{{$val["tahun_ajaran"]}}</td>
                            <td>
                            <a href="{{url('/cart/hapus/'.$ct)}}">Hapus</a>
                            </td>
                        </tr>
                        <?php
                        $total+=$totalsemua;
                        ?>
                        @endforeach
                        <tr>
                          <th colspan="2"> Total Pembayaran :</th>
                          <th>{{$total}}</th>
                        </tr>
                    </tbody>
                    
                    </table>
                    @endif
                  </div>
                 </div>
                  </div>
                
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection

@push('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var id_kelas =  $(this).closest("id_kelas");
          event.preventDefault();
          swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          })
          .then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Your data has been deleted.',
                'success'
                )
            }
        });
      });
  
</script>    
@endpush