@extends('layouts.admin')
@section('title', 'Edit Akun')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Akun</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a>Edit Akun</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-12 col-lg-8 offset-lg-2">
                                    <div class="wizard-steps">
                                        <div class="wizard-step wizard-step-active">
                                            <div class="wizard-step-icon">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Edit Account
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="wizard-content mt-1"
                                action="{{ route('data-akun.update', Auth::user()->id_petugas) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="wizard-pane">
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Nama</label>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ Auth::user()->nama }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Alamat</label>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" name="alamat" class="form-control"
                                                value="{{ Auth::user()->alamat }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Telephone</label>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="integer" name="telephone" class="form-control"
                                                value="{{ Auth::user()->telephone }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">username</label>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" name="username" class="form-control"
                                                value="{{ Auth::user()->username }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Password</label>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="password" name="password" class="form-control"
                                                value="{{ Auth::user()->password }}" required>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var id_kelas = $(this).closest("id_kelas");
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
