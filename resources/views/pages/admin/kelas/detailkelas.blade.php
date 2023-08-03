@extends('layouts.admin')
@section('title', 'Detail Kelas')

@section('content')

 <!-- Main Content -->

 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Kelas</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ url('data-kelas') }}">Data Kelas</a></div>
              <div class="breadcrumb-item"><a>Detail Kelas</a></div>
            </div>
          </div>
         
      <div class="card col-12 col-md-6 col-lg-12">
      <div class="card-heade">
            <div class="card-header">
            <form action="{{ route('detailkelas') }}" method="GET" enctype="multipart/form-data">
                        @csrf

                              <div class="input-group" style="margin-left: 100px">
                                  
                                  <select name="tahun" id="" class="form-control" value="{{ old('tahunakademik') }}"   required>

                                     <option value="">-- Pilih Tahun Ajaran --</option>
                                     @foreach($tahunakademik as $tha => $th)

                                    <option value="{{$th->nama_tahunakademik}}">{{$th->nama_tahunakademik}}</option>
                                     @endforeach
                                  </select>

                                  
                                  <select name="kelas" id="" style="margin-left: 15px" class="form-control" value="{{ old('kelas') }}"   required>

                                     <option value="">-- Pilih Kelas --</option>
                                     @foreach($kelas as $kel => $k)

                                    <option value="{{$k->nama_kelas}}">{{$k->nama_kelas}}</option>
                                     @endforeach
                                  </select>

                                  <select name="status_siswa" id="" style="margin-left: 15px" class="form-control" value="{{ old('status_siswa') }}"   required>

                                     <option value="">-- Pilih Status Siswa --</option>
                                     <option value="aktif">Aktif</option>
                                     <option value="nonaktif">Non Aktif</option>
                                  </select>
                                  

                               <div class="form-group-btn" style="margin-left: 15px; margin-top: 5px">
                              <button class="btn btn-icon icon-left btn-primary"><i class="fa fa-search"></i> Cari</button>
                           </div>
                         </div>
                    </form>
                    
            </div>
      <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped" id="kelasTable">
            <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tahun Akademik</th>
                <th>Status</th>
                <th>Action</th>

              </tr>
            </thead>

              <form action="{{ route('naikkelas') }}" method="GET" enctype="multipart/form-data">
            <tbody>
                        @csrf
                @foreach($detailkelas as $i => $kel)
                <tr>
                    <td>{{ $i += 1}}</td>
                    <td>{{ $kel -> siswa -> nisn}} </td>
                    <td>{{ $kel -> siswa -> nama}} </td>
                    <td>{{ $kel -> kelas -> nama_kelas}} </td>
                    <td>{{ $kel -> tahunakademik -> nama_tahunakademik}} </td>
                    @if($kel->status_siswa == 'nonaktif' AND $kel->kelas->nama_kelas =='XI A')
                      <td>Non Aktif </td>
                      <td>Lulus </td>
                    @elseif($kel->status_siswa == 'aktif')
                      <td>Aktif </td>
                      <td>Naik Kelas </td>
                    @else
                      <td>Non Aktif </td>
                      <td>Naik Kelas </td>
                    @endif


                    @if($kel->status_detail == 'a')
                    <td>
                    <div class="form-group">

                    <input type="checkbox" id="checkboxAll" name="status[]" value="{{$kel->id_detail_kelas}}"> Non Aktif

                    </td>
                    @endif
                  </div>
                </tr>

                @endforeach
              
            </tbody>
             
            </table>

            @if(empty($status_siswa) OR $status_siswa=='a')
            
            <input type="button" value="Edit Siswa"  data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
            <hr>
            @endif
          
            <div  class="card-body col-md-3 accordion-body collapse" id="demo1">
              <div class="form-group">

                      <div class="form-group">
                                <label for="">Tahun Pelajaran Tujuan</label>
                                <select name="tahun" id="" class="form-control" value="{{ old('tahun') }}"   required>

                                     <option value="">-- Pilih Tahun Ajaran --</option>
                                     @foreach($akademikselanjutnya as $tha => $th)

                                    <option value="{{$th->id_tahunakademik}}">{{$th->nama_tahunakademik}}</option>
                                     @endforeach
                                  </select>
                     </div>

                     <div class="form-group">
                       <label for="">Kelas Tujuan</label>
                            <select name="kelastujuan" id="" class="form-control" value="{{ old('kelastujuan') }}"   required>

                                     <option value="">-- Pilih Kelas --</option>
                                     @foreach($kelas as $kel => $k)

                                    <option value="{{$k->id_kelas}}">{{$k->nama_kelas}}</option>
                                     @endforeach
                                     <option value="lulus">Lulus</option>
                                  </select>
                       
                     </div>

                      <div  class="form-group">
                        <button id="btn" class="btn btn-icon icon-left btn-primary"></i> SIMPAN</button>
                      </div>
                    </div>
               </div>
            </div>
            </form>

          </div>
      </div>
    </div>
        </section>
      </div>
</div>
@endsection

@push('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
 
 $(document).ready(function(){
  $('checkboxAll').click(function(){
    $(".chkbox").prop('checked', $ (this).prop('checked'));
  });
 });

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