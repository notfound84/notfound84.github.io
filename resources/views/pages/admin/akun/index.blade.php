@extends('layouts.admin')
@section('title', 'Detail Akun')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Akun</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a>Data Akun</a></div>
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
                                                User Account
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="wizard-content mt-1" action="" method="POST">
                                <div class="wizard-pane">
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Nama</label>
                                        <div class="col-lg-6 col-md-6">
                                            <label type="text" name="name"
                                                class="form-control">{{ Auth::user()->nama }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Alamat</label>
                                        <div class="col-lg-6 col-md-6">
                                            <label type="text" name="name"
                                                class="form-control">{{ Auth::user()->alamat }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Telephone</label>
                                        <div class="col-lg-6 col-md-6">
                                            <label type="text" name="name"
                                                class="form-control">{{ Auth::user()->telephone }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">username</label>
                                        <div class="col-lg-6 col-md-6">
                                            <label type="text" name="name"
                                                class="form-control">{{ Auth::user()->username }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-md-4 text-md-right text-left">Level</label>
                                        <div class="col-lg-6 col-md-6">
                                            <label type="text" name="name"
                                                class="form-control">{{ Auth::user()->level }}</label>
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
