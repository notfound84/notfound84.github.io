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
                    <h4>Data Siswa</h4>
                    <form class="card-header-form"  method="get" action="{{ route('carinisn') }}">
                      <div class="input-group">
                        <input type="text" name="carinisn" class="form-control" id="carinisn" placeholder="Masukkan NISN">
                        <div class="input-group-btn">
                          <button  type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
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
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                          @foreach($siswa as $i => $sis)
                          <tr>
                              <td>{{ $i += 1}}</td>
                              <td>{{ $sis -> nisn}} </td>
                              <td>{{ $sis -> nama}} </td>
                              <td>{{ $sis -> kelas->nama_kelas}} </td>
                              <td>
                                  <a href="{{url('/pilihsiswa/'.$sis->nisn)}}"class="btn btn-danger btn-action mr-1" data-toggle="tooltip">Pilih</a>
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