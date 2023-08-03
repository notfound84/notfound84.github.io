@extends('layouts.admin')
@section('title', 'Data Petugas')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Petugas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="">Data Petugas</a></div>
                </div>
            </div>

            <div class="card col-12 col-md-6 col-lg-12">
                <div class="card-header">
                    <h4><a href="{{ route('data-user.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                class="far fa-tabel"></i> Tambah Data</a></h4>
                    <form class="card-header-form" method="get" action="{{ route('cariuser') }}">
                        <div class="input-group">
                            <input type="text" name="cariuser" class="form-control" id="cariuser"
                                placeholder="Masukkan Nama">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-icon"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="petugasTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>username</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($user as $i => $us)
                                    <tr>
                                        <td>{{ $i += 1 }}</td>
                                        <td>{{ $us->nama }} </td>
                                        <td>{{ $us->username }} </td>
                                        <td>{{ $us->alamat }} </td>
                                        <td>
                                            <?php
                       if ($us->level=="admin") {
                        ?>
                                            <span class="badge badge-danger"><?= $us->level ?></span>
                                            <?php
                       } else if  ($us->level=="Bendahara") {
                        ?>
                                            <span class="badge badge-primary"><?= $us->level ?></span>
                                            <?php
                      } else {
                        ?>
                                            <span class="badge badge-warning"><?= $us->level ?></span>
                                            <?php
                      }     
                    ?>
                                        </td>
                                        <td>
                                            <a href="{{ route('data-user.edit', $us->id_petugas) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('data-user.destroy', $us->id_petugas) }}"
                                                class="d-inline" method="POST" id="delete{{ $us->id_petugas }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action delete-btn"
                                                    data-toggle="tooltip">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
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
            var id_petugas = $(this).closest("id_petugas");
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
