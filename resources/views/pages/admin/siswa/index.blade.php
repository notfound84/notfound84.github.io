@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Siswa</h1>
          </div>
         
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><a href="{{ route('data-siswa.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-user"></i> Tambah Siswa</a></h4>
                    <form action="{{ route('data-siswa.index') }}" method="GET" enctype="multipart/form-data">
                        @csrf

                              <div class="input-group" style="margin-left: 90px">
                                  
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
              </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped" id="siswaTable">
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

                      <tbody>
                        <?php $no=1; ?>
                          @foreach($siswa as $i => $sis)
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $sis -> nisn}} </td>
                              <td>{{ $sis -> nama}} </td>
                              <td>{{ $sis -> kelas->nama_kelas}} </td>
                              <td>{{ $sis -> tahunakademik->nama_tahunakademik}} </td>
                                  @if($sis->status_siswa=='aktif')
                                  <td>Aktif </td>
                                  @else
                                  <td>Non Aktif </td>
                                  @endif
                            
                              <td>
                                  <a href="{{ route('data-siswa.edit', $sis->id_siswa)}}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                  <a href="{{ route('data-siswa.show', $sis->id_siswa)}}" class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Detail"><i class="fas fa-list-alt"></i></a>
                              </td>
                          </tr>

                          @endforeach
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
 
     $('.show_confirm').click(function(event) {
          var nisn =  $(this).closest("nisn");
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