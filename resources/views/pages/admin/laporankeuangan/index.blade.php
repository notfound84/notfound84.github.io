@extends('layouts.admin')
@section('title', 'Data Laporan Keuangan')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Laporan Keuangan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a>Data Laporan Keuangan</a></div>
                </div>
            </div>

            <div class="card col-12 col-md-6 col-lg-12">
                <div class="card-heade">
                    <div class="card-header">
                        <form action="{{ route('laporan-keuangan.index') }}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group" style="margin-left: 40px">
                                <select name="tahun" id="" class="form-control" value="{{ old('tahun') }}"
                                    required>
                                    <option value="">-- Pilih Tahun Akademik --</option>
                                    @foreach ($tahunajar as $tha => $th)
                                        <option value="{{ $th->nama_tahunakademik }}">{{ $th->nama_tahunakademik }}</option>
                                    @endforeach
                                </select>
                                <select name="kelascari" id="" style="margin-left: 15px" class="form-control"
                                    value="{{ old('kelascari') }}" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $kel => $k)
                                        <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group-btn" style="margin-left: 15px; margin-top: 5px">
                                    <button class="btn btn-icon icon-left btn-primary"><i class="fa fa-search"></i>
                                        Cari</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('cetakkeuangan') }}" target="_blank" method="GET"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tahun" class="form-control" value="{{ $tahun }}" required>
                            <input type="hidden" name="kelascari" class="form-control" value="{{ $kelascari }}"
                                required>

                            <button style="margin-left: 60px" class="btn btn-icon icon-left btn-success"><i
                                    class="fa fa-print"></i> Cetak Laporan Keuangan</button>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="kasTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tahun Pelajaran</th>
                                        <th>LKS</th>
                                        <th>Infaq</th>
                                        <th>Semester</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $total = 0;
                                    $no = 1;
                                    ?>
                                    @foreach ($detailpembayaran as $k)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $k[0]->nisn }}</td>
                                            <td>{{ $k[0]->nama }}</td>
                                            <td>{{ $k[0]->nama_kelas }}</td>
                                            <td>{{ $k[0]->nama_tahunakademik }}</td>
                                            <td>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($k as $urai)
                                                    @if ($urai->rincianpembayaran->uraian_pembayaran == 'LKS')
                                                        @php
                                                            $total += $urai->rincianpembayaran->nominal;
                                                        @endphp
                                                        {{ number_format($urai->rincianpembayaran->nominal) }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($k as $urai)
                                                    {{-- @dd($urai) --}}
                                                    @if ($urai->rincianpembayaran->uraian_pembayaran == 'INFAQ')
                                                        @php
                                                            $total += $urai->rincianpembayaran->nominal;
                                                        @endphp
                                                        {{ number_format($urai->rincianpembayaran->nominal) }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($k as $urai)
                                                    @if (isset($urai->rincianpembayaran->uraian_pembayaran) &&
                                                            strtoupper($urai->rincianpembayaran->uraian_pembayaran) == strtoupper('Semester'))
                                                        @php
                                                            $total += $urai->rincianpembayaran->nominal;
                                                        @endphp
                                                        {{ number_format($urai->rincianpembayaran->nominal) }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($total) }}</td>
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
            var id_kas = $(this).closest("id_kas");
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
