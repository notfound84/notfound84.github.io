@extends('layouts.admin')
@section('title', 'Detail Siswa')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Siswa</h1>
          </div>

      <div class="row">
              <div class="col-7">
                <div class="card">
                  <div class="card-body">
                    <div class="row mt-4">
                      <div class="col-12 col-lg-8 offset-lg-2">
                        <div class="wizard-steps">
                          <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-label">
                              <form action="{{ route('data-siswa.update', $siswa->nisn) }}">
                              <img widht="215px" height="150px" src="{{ asset('img/'. $siswa->foto) }}" alt="">
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form class="wizard-content mt-1" action="" method="POST">
                      <div class="wizard-pane">
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">NISN</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->nisn}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Nama</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->nama}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Tempat Lahir</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->tempat_lahir}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Tangal Lahir</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->tgl_lahir}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Jenis Kelamin</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->jenis_kelamin}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Alamat</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->alamat}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Nomer Telpon</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->no_telp}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Nama Ayah</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->nama_ayah}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Nama Ibu</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->nama_ibu}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Pekerjaan Ayah</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->pekerjaan_ayah}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Pekerjaan Ibu</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->pekerjaan_ibu}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Kelas</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->kelas->nama_kelas}}</label>
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Tahun Akademik</label>
                          <div class="col-lg-6 col-md-6">
                          <label type="text" name="name" class="form-control">{{ $siswa->tahunakademik->nama_tahunakademik}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-4"></div>
                          <div class="col-lg-4 col-md-6 text-right">
                            <a href="{{ route('data-siswa.index') }}" class="btn btn-icon icon-right btn-primary">Kembali <i class="fas fa-arrow-left"></i></a>
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
