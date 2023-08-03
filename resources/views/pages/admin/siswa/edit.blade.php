@extends('layouts.admin')
@section('title', 'Edit Data Siswa')

@section('content')

 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit Data Siswa</h1>
          </div>
         
          <div class="section-body">
            <div class="row">
              <div class="col-xl-7">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ route('data-siswa.index') }}" class="btn btn-icon icon-left btn-primary"> Kembali </a>
                  </div>
                  <div class="card-body p-0">
                    <form action="{{ route('data-siswa.update', $siswa->id_siswa) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">NISN</label>
                                <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">NAMA</label>
                                <input type="text" name="nama" class="form-control" value="{{ $siswa->nama}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">TEMPAT LAHIR</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir}}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="{{ $siswa->tgl_lahir}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <br>
                                  <input type="radio" id="" name="jenis_kelamin" value="laki-laki" <?php if ($siswa->jenis_kelamin == 'laki-laki') echo 'checked="checked"';?>>  Laki-Laki</label>

                                <input type="radio" id="" name="jenis_kelamin" value="perempuan" <?php if ($siswa->jenis_kelamin == 'perempuan') echo 'checked="checked"';?>>  Perempuan</label>
                            </div>
                            <div class="form-group">
                                <label for="">ALAMAT</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $siswa->alamat}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">NOMER TELPON</label>
                                <input type="text" name="no_telp" class="form-control" value="{{ $siswa->no_telp}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">NAMA AYAH</label>
                                <input type="text" name="nama_ayah" class="form-control" value="{{ $siswa->nama_ayah}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">NAMA IBU</label>
                                <input type="text" name="nama_ibu" class="form-control" value="{{ $siswa->nama_ibu}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">PEKERJAAN AYAH</label>
                                <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" value="{{ $siswa->pekerjaan_ayah}}" required>
                                  <option value="{{ $siswa->pekerjaan_ayah}}">{{ $siswa->pekerjaan_ayah}}</option>
                                  <option value="Petani">Petani</option>
                                  <option value="Nelayan">Nelayan</option>
                                  <option value="Guru">Guru</option>
                                  <option value="Pedagang">Pedagang</option>
                                  <option value="Wirasuwasta">Wirasuwasta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">PEKERJAAN IBU</label>
                                <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" value="{{ $siswa->pekerjaan_ibu}}" required>
                                  <option value="{{ $siswa->pekerjaan_ibu}}">{{ $siswa->pekerjaan_ibu}}</option>
                                  <option value="Petani">Petani</option>
                                  <option value="Nelayan">Nelayan</option>
                                  <option value="Guru">Guru</option>
                                  <option value="Pedagang">Pedagang</option>
                                  <option value="Ibu rumah tangga">Ibu Rumah Tangga</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">KELAS</label>
                                <select name="id_kelas" id="" class="form-control" value="{{ old('id_kelas') }}" required>
                                  <option value="{{ $siswa->id_kelas}}">{{ $siswa->kelas->nama_kelas}}</option>
                                     @foreach($kelas as $kel => $k)
                                    <option value="{{$k->id_kelas}}">{{$k->nama_kelas}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">TAHUN AKADEMIK</label>
                                <select name="id_tahunakademik" id="" class="form-control" value="{{ old('id_tahunakademik') }}" required>
                                  <option value="{{ $siswa->id_tahunakademik}}">{{ $siswa->tahunakademik->nama_tahunakademik}}</option>
                                     @foreach($tahunakademik as $thn => $th)
                                    <option value="{{$th->id_tahunakademik}}">{{$th->nama_tahunakademik}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                            
                        </div>
                        
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
</div>
@endsection
