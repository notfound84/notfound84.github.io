@extends('layouts.admin')
@section('title', 'Data Kelas')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Kelas</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a>Data Kelas</a></div>
            </div>
          </div>
         
      <div class="card col-12 col-md-6 col-lg-7">
      <div class="card-heade">
            <div class="card-header">
                    <h4> <a href="{{ route('data-kelas.create') }}" class="btn btn-primary btn-icon icon-left"><i class="far fa-tabel"></i> Tambah Kelas</a></h4>
                    <h4> <a href="{{ route('detailkelas') }}" class="btn btn-warning btn-icon icon-left"><i class="far fa-tabel"></i> Detail Kelas</a></h4>
                    <form class="card-header-form"  method="get" action="{{ route('carikelas') }}">
                      <div class="input-group">
                        <input type="text" name="carikelas" class="form-control" id="carikelas" placeholder="Cari Kelas">
                        <div class="input-group-btn">
                          <button  type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
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
                <th>Nama Kelas</th>
                <th>Status Kelas</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
                @foreach($kelas as $i => $kel)
                <tr>
                    <td>{{ $i += 1}}</td>
                    <td>{{ $kel -> nama_kelas}} </td>
                    @if($kel->status == 'a')
                    <td>Aktif </td>
                    @else
                    <td>Non Aktif </td>
                    @endif
                    <td>
                        <a href="{{ route('data-kelas.edit', $kel->id_kelas)}}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('data-kelas.destroy', $kel->id_kelas) }}" class="d-inline" method="POST" id="delete{{$kel->id_kelas}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action fas fa-trash delete-btn" data-toggle="tooltip" title="Delete" ></button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
             
            </table>
            {{ $kelas->links() }}
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