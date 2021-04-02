<?php
require 'koneksi.php';
   if( isset( $_REQUEST['sub'] )){
      $sub = $_REQUEST['sub'];
      
      include "laporan_tagihan.php";
   } else {
   
      if(isset($_REQUEST['submit'])){
         $submit = $_REQUEST['submit'];
         $tgl1 = $_REQUEST['tgl1'];
         $tgl2 = $_REQUEST['tgl2'];
         
         //echo $tgl1.'-'.$tgl2;
         $q = "SELECT *,sum(jumlah_bayar) as data FROM pembayaran WHERE tgl_bayar BETWEEN '$tgl1' AND '$tgl2' GROUP BY id_pembayaran";
         
         echo '<h2>Rekap <small>'.$tgl1.' sampai '.$tgl2.'</small></h2><hr>';
         echo '<a class="noprint pull-right btn btn-default" onclick="fnCetak()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>';
         
      } else {
         $tgl = date("Y/m/d");
         $q = "SELECT *, sum(jumlah_bayar) AS data FROM pembayaran WHERE tgl_bayar='$tgl' GROUP BY id_pembayaran";
         echo '<h2>Rekap <small>'.$tgl.'</small></h2><hr>';
      }
      
      $sql = mysqli_query($koneksi,$q);
      
      echo '<div class="row">';
      echo '<div class="col-md-5">';
?>
<div class="well well-sm noprint">
<form class="form-inline" role="form" method="post" action="">
  <div class="form-group">
    <label class="sr-only" for="tgl1">Mulai</label>
    <input type="date" class="form-control" id="tgl1" name="tgl1">
  </div>
  <div class="form-group">
    <label class="sr-only" for="tgl2">Hingga</label>
    <input type="date" class="form-control" id="tgl2" name="tgl2">
  </div>
  <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
</form>
</div>
<?php
      echo '<table class="table table-bordered">';
      echo '<tr class="success"><th width="50">No</th><th>NISN</th><th>Jumlah</th></tr>';
      
      $total = 0;
      $no=1;
      while(list($id1,$id2,$nisn,$tgl,$bln,$thn,$id3,$jml) = mysqli_fetch_array($sql)){
         echo '<tr><td>'.$no.'</td><td>'.$nisn.'</td><td><span class="pull-right">'.$jml.'</span></td></tr>';
         $total += $jml;
         $no++;
      }
      
      echo '<tr><td colspan="2"><span class="pull-right">T O T A L</span></td><td><span class="pull-right">'.$total.'</span></td></tr>';
      echo '</table>';
      echo '</div></div>';
   }

?>