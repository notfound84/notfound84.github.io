<!DOCTYPE html>
<html>
<head>
	<title>Bukti Pembayaran Siswa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 10pt;
		}
	</style>
	<center>
		
		<h5><u>BUKTI PEMBAYARAN SISWA</u></h4>
		<p style="font-size: 9pt; font-style: italic;">Tanggal Cetak : {{$date}}</p>
	</center>
	<hr style="border: solid;">
	
			 <div style="font-size: 16px; color: blue; padding-bottom: 10px">
                    <a>Data Siswa</a>
             </div>

	 	
            <table class="table table-striped">
                <tbody>
                   @foreach($pembayaran as $i => $pem)
                       @if($loop->first)
                      @foreach($pem as $pe)
                     

                    <tr>
                        <td style="font-weight: bold;">NISN</td>
                        <td style="font-weight: bold;">: {{$pe->nisn}}</td>
                        <td style="font-weight: bold;">Kelas</td>
                        <td style="font-weight: bold;">: {{$pe->nama_kelas}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Nama </td>
                        <td style="font-weight: bold;">: {{$pe->nama_siswa}}</td>
                        
                        <td style="font-weight: bold;">Tahun Akademik</td>
                        <td style="font-weight: bold;">: {{$pe->nama_tahunakademik}}</td>
                      
                    </tr>
                       @endforeach
                         @endif
                        @endforeach
                </tbody>
            </table>
      
       <hr>
        	<div style="font-size: 16px; color: blue; padding-bottom: 10px">
                <a>Rincian Pembayaran</a>
            </div>
                    
 
	<table class="table table-striped" id="pembayaranTable">
                    <thead>
                    <tr class="bg-primary color white">
                        <th style="color: white;">No</th>
                        <th style="color: white;">Uraian Pembayaran</th>
                        <th style="color: white;">Nominal</th>
                        <th style="color: white;">Tahun Akademik</th>
                      </tr>
                    </thead>



                      <?php 
                      $no=1;
                    	$totalpem=0;
                      ?>
                    @foreach($pembayaran as $i => $pem)
                   

                        <?php   $nomor=1; ?>

                         @foreach($pem as $deta)
                          
                           <tbody>
                             

                                <td style="font-size: 10pt;">{{$nomor++}}</td>
                                <td style="font-size: 10pt;">{{ $deta->uraian_pembayaran }}</td>
                                <td style="font-size: 10pt;">{{$deta->nominal}}</td>
                                <td style="font-size: 10pt;"> {{$deta->nama_tahunakademik}}</td>
                           </tbody>
                      
                        @endforeach

                       
                         @foreach($pem as $as)
                         


                     @if($loop->first)
                     <?php
                     	$tgl = date("m-d-Y", strtotime($as->tgl_pembayaran)); 
                     
                     	?>

                    
                        <tr style="background-color: #e1e1ea" >
                          <td colspan="2" style="font-weight: bold;">Tanggal Pembayaran   : {{$tgl}}  <br>Petugas : {{$as->nama_petugas}}</td>
                          <td colspan="2" style="font-weight: bold;">{{$as->total_pembayaran}}</td>
                       
                             
                                 <!-- <button class="btn btn-icon icon-left btn-success">Cetak</button> -->


                              
                    
                        </td>
                        </tr>

                         
                                @endif
                     	

                        @endforeach
                         <?php $totalpem+=$as->total_pembayaran; ?>
                         @endforeach

			<tr class="bg-primary color white">
				<td colspan="2" style="color: white; font-style: bold;">Total Pembayaran :</td>
				<td colspan="1" style="color: white; font-style: bold;">{{$totalpem}}</td>
			</tr>
                    
                  
                    </tbody>
                    
                    </table>
 
</body>
</html>