<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-widht, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <style type="text/css">
        table tr td,
        table tr th{
            font-size: 10pt;
        }
    </style>
    
    <title>CETAK LAPORAN KEUANGAN</title>
</head>
<body>
    <div class="form-group">
        <h4 align="center">PONDOK PESANTREN NURUL HASYIMI </h4>
        <p align="center" style="padding-top: -30px"><b>Laporan Keuangan Siswa</b></p>
        <p align="center" style="font-size: 9pt; padding-bottom:60px font-style: italic;">Tanggal Cetak : {{$date}}</p>
        <table class="table table-striped solid" id="kasTable">
            <thead>
            <tr class="bg-primary">
                <th style="color: black;">No</th>
                <th style="color: black;">NISN</th>
                <th style="color: black;">Nama</th>
                <th style="color: black;">Kelas</th>
                <th style="color: black;">Tahun Pelajaran</th>
                <th style="color: black;">LKS</th>
                <th style="color: black;">Infaq</th>
                <th style="color: black;">Semester</th>
                <th style="color: black;">Total</th>
              </tr>
            </thead>

            <tbody>
            <?php 
              $total=0;
              $no=1;
            ?>
                @foreach($detailpembayaran as $k)
                
                <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $k[0] -> nisn}}</td>
                    <td>{{ $k[0] -> nama}}</td>
                    <td>{{ $k[0] -> nama_kelas}}</td>
                    <td>{{ $k[0] -> nama_tahunakademik}}</td>
                    <td>
                    @php
                            $total = 0;
                        @endphp
                        @foreach($k as $urai)
                            @if($urai->rincianpembayaran->uraian_pembayaran=="LKS")
                            @php
                                $total += $urai->rincianpembayaran->nominal;
                            @endphp
                            {{ number_format($urai->rincianpembayaran->nominal) }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($k as $urai)
                            @if($urai->rincianpembayaran->uraian_pembayaran=="INFAQ")
                            @php
                                $total += $urai->rincianpembayaran->nominal;
                            @endphp
                            {{ number_format($urai->rincianpembayaran->nominal) }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($k as $urai)
                                @if(isset($urai->rincianpembayaran->uraian_pembayaran) && strtoupper($urai->rincianpembayaran->uraian_pembayaran) == strtoupper("Semester"))
                                @php
                                    $total += $urai->rincianpembayaran->nominal;
                                @endphp
                                {{ number_format($urai->rincianpembayaran->nominal) }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{number_format($total)}}</td>
                @endforeach
            </tbody>
            </table>
    </div>
</body>

</html>