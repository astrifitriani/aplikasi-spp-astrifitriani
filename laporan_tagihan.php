<?php
   require 'koneksi.php';
   echo '<h2>Tagihan Pembayaran</h2><hr>';
   echo '<a class="noprint pull-right btn btn-default" onclick="fnCetak()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>';
   $sql = mysqli_query($koneksi,"SELECT * FROM siswa s,kelas k,pembayaran p GROUP BY s.nama");
   
   echo '<div class="row">';
   echo '<div class="col-md-7">';
   echo '<table class="table table-bordered">';
   echo '<tr class="success"><th width="50">#</th><th>NISN</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Status</th></tr>';
   
   $no=1;
   while(list($nis,$nama,$kls,$bln,$jml)=mysqli_fetch_array($sql)){
      echo '<tr><td>'.$no.'</td><td>'.$nis.'</td><td>'.$nama.'</td><td>'.$kls.'</td>';
      if(empty($bln) AND empty($jml)){
         echo '<td>--</td><td>BL</td></tr>';
      } else {
         echo '<td>'.$bln.'</td><td>LUNAS</td></tr>';
      }
      $no++;
   }
   echo '</table></div></div>';

?>