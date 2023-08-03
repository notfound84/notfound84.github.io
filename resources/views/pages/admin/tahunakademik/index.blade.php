@extends('layouts.admin')
@section('title', 'Data Tahun Akademik')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Tahun Akademik</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a>Data Tahun Akademik</a></div>
            </div>
          </div>
         
      <div class="card col-12 col-md-6 col-lg-7">
      <div class="card-heade">
            <div class="card-header">
                    <h4> <a href="{{ route('data-tahunakademik.create') }}" class="btn btn-primary btn-icon icon-left"><i class="far fa-tabel"></i> Tambah Kelas</a></h4>
                    <form class="card-header-form"  method="get" action="{{ route('caritahun') }}">
                      <div class="input-group">
                        <input type="text" name="caritahun" class="form-control" id="caritahun" placeholder="Cari Tahun">
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
                <th>Tahun Akademik</th>
                <th>Status </th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
                @foreach($tahunakademik as $i => $kel)
                <tr>
                    <td>{{ $i += 1}}</td>
                    <td>{{ $kel -> nama_tahunakademik}} </td>
                    <td>{{ $kel -> status}} </td>
                    <td>
                        <a href="{{ route('data-tahunakademik.edit', $kel->id_tahunakademik)}}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('data-tahunakademik.destroy', $kel->id_tahunakademik) }}" class="d-inline" method="POST" id="delete{{$kel->id_tahunakademik}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action fas fa-trash delete-btn" data-toggle="tooltip" title="Delete" ></button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
             
            </table>
            {{ $tahunakademik->links() }}
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