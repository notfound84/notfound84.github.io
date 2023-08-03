@extends('layouts.admin')
@section('title', 'Pembayaran')

@section('content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Cek Pembayaran</h1>
            <!-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Pembayaran</div>
            </div> -->
          </div>
          <div class="">
              <div class="col-12 col-md-6 col-lg-12">
                
            <div class="row">
              <div class="col-12 col-md-4 col-lg-4">
                <div class="card card-primary" style="margin-left: -10px; margin-right: 11px">
                  <div class="card-header" style="margin-right: 30px">
                    <h4 style="">Cari Pembayaran Siswa</h4>
                    <a href="{{ route('data-pembayaran.index') }}" class="btn btn-icon icon-left btn-primary"> Kembali </a>
                  </div>
                  
                   <form action="{{ route('cekpembayaran') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ old('nisn') }}" required>
                    </div>
                    
                    <div class="form-group">
                      <div class="form-group">
                                <label for="">Tahun Pelajaran</label>
                                <select name="tahun" id="" class="form-control" value="{{ old('tahun') }}"   required>

                                   <option value="">-- Pilih Tahun Ajaran --</option>
                                   @foreach($tahunajar as $tha => $th)

                                  <option value="{{$th->nama_tahunakademik}}">{{$th->nama_tahunakademik}}</option>
                                   @endforeach
                                </select>
                            </div>
                          </div>
                      <br>
                      <h4><button class="btn btn-icon icon-left btn-primary"><i class="fa fa-search"></i> Cari</button></h4>
                  
                  </div>
                </div>
              </div>
            </form>


              <div class="col-12 col-md-8 col-lg-8">
                <div class="card card-success" style="margin-right: -15px; margin-left: -17px">
                 

                  
                  @if(empty($nisn))
                  <div class="card-header">
                    <h4>Data Pembayaran</h4>
                  </div>
                  <div class="card-body">
                    <div class="card-body">
                    
                        
                            <div style="margin-top: -20px" class="alert alert-danger">
                            <b>Note!</b> Belum ada transaksi pembayaran yang dicari.
                            </div>
                        </div>
                    @else

                     <div class="card-header">
                    <h4>Data Siswa</h4>
                  </div>
                  <div class="card-body">
                <div class="card-body p-0"> 
                <div class="table-responsive">
                   <table class="table table-striped" id="pembayaranTable">
                    <thead>
                      @foreach($pembayaran as $i => $pem)
                      @if($loop->first) 
                      @foreach($pem as $pe)
                      @if($loop->first) 
                    
                     
                    <tr>
                        <th>NISN</th>
                        <th>: {{ $pe ->nisn}}</th>
                        <th>Kelas</th>
                        <th>: {{ $pe ->nama_kelas}}</th>

                      </tr>
                    </thead>

                    <tbody>
                    
                        <tr>
                            <th>Nama</th>
                            <th>: {{ $pe ->nama_siswa}} </th>
                            <th>Tahun Akademik</th>
                            <th>: {{ $pe ->nama_tahunakademik}} </th>
                   
                                
                            </td>
                        </tr>
                       @endif
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                    
                    </table>
                  </div>
                </div>
              </div>

                <div class="card-header" style="margin-top: -20px">
                    <h4>Rincian Pembayaran Siswa</h4>
                     
                  </div>
                  <div class="card-body">
                  <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="pembayaranTable">
                    <thead>
                    <tr class="bg-primary color white">
                        <th style="color: white;">No</th>
                        <th style="color: white;">Uraian Pembayaran</th>
                        <th style="color: white;">Nominal</th>
                        <th style="color: white;">Tahun Akademik</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      $totalpem=0;
                      ?>
                    @foreach($pembayaran as $i => $pem)
                        <?php   $nomor=1; ?>
                         @foreach($pem as $deta)
                           <tbody>
                                <td>{{$nomor++}}</td>
                                <td>{{ $deta->uraian_pembayaran }}</td>
                                <td>{{$deta->nominal}}</td>
                                <td> {{$deta->nama_tahunakademik}}</td>
                           </tbody>
                        @endforeach
                         @foreach($pem as $as)
                     @if($loop->first)
                     <?php
                      $tgl = date("d-m-Y", strtotime($as->tgl_pembayaran)); 
                      ?>
                        <tr style="background-color: #e1e1ea" >
                          <td colspan="2" style="font-weight: bold;">Tanggal Pembayaran   : {{$tgl}}  <br>Petugas : {{$as->nama_petugas}}</td>
                          <td colspan="2" style="font-weight: bold;">{{$as->total_pembayaran}}</td>
                            
                             <!--  <td >

                            <form action="{{ route('cetak') }}" target="_blank" method="GET" enctype="multipart/form-data">
                                @csrf
                              <input type="hidden" name="nisn" class="form-control" value="{{ $as->nisn }}" required>
                              <input type="hidden" name="tahun" class="form-control" value="{{ $as->nama_tahunakademik }}" required>
                                                 
                            <button style="padding-bottom: ;" class="btn btn-icon icon-left btn-success"><i class="fa fa-print"></i> Cetak</button>
                          </form>
                            
                        </td> -->
                        </tr>
                     
                         
                                @endif

                        @endforeach
                         <?php $totalpem+=$as->total_pembayaran; ?>
                         @endforeach

                         <tr class="bg-primary color white">
        <td colspan="2" style="color: white; font-style: bold;">Total Pembayaran :</td>
        <td colspan="1" style="color: white; font-style: bold;">{{$totalpem}}</td>
        <td >

            <form action="{{ route('cetaksemua') }}" target="_blank" method="GET" enctype="multipart/form-data">
                @csrf
              <input type="hidden" name="nisn" class="form-control" value="{{ $nisn }}" required>
              <input type="hidden" name="tahun" class="form-control" value="{{ $tahun }}" required>
                                 
            <button style="padding-bottom: ;" class="btn btn-icon icon-left btn-success"><i class="fa fa-print"></i> Cetak Pembayaran</button>
          </form>
    
        </td> 
      </tr>
                  
                    </tbody>
                    
                    </table>
                  </div>
                 </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
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