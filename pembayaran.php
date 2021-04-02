<?php

	/* tahapan pembayaran SPP
		1. masukkan nis
		2. tampilkan histori pembayaran (jika ada) dan form pembayaran
		3. proses pembayaran, kembali ke nomor 2
	*/
	echo '<h2>Pembayaran</h2><hr>';
	
	if(isset($_REQUEST['submit'])){
		//proses pembayaran secara bertahap
		$submit = $_REQUEST['submit'];
		$nis = $_REQUEST['nis'];
		
		//proses simpan pembayaran
		if($submit=='bayar'){
			$bln = $_REQUEST['bln'];
			$tgl = $_REQUEST['tgl'];
			$jml = $_REQUEST['jml'];
			$thn = $_REQUEST['thn'];
			$spp = $_REQUEST['spp'];
			$petugas=$_SESSION['iduser'];
			$nisn=$_REQUEST['nis'];
			
			$qbayar = mysqli_query($koneksi,"INSERT INTO pembayaran VALUES('','$petugas','$nisn','$tgl','$bln','$thn','$spp','$jml')");
			
			if($qbayar > 0){
				header('Location: ./admin.php?hlm=bayar');
				die();
			} else {
				echo 'ada ERROR dg query';
			}
		}
		
		//proses hapus pembayaran, hanya ADMIN
		if($submit=='hapus'){
			$bln = $_REQUEST['bln'];
			$tgl = $_REQUEST['tgl'];
			$jml = $_REQUEST['jml'];
			$thn = $_REQUEST['thn'];
			$spp = $_REQUEST['spp'];
			$petugas=$_SESSION['iduser'];
			$nisn=$_REQUEST['nis'];
			
			$qbayar = mysqli_query($koneksi,"DELETE FROM pembayaran WHERE nisn='$nis' AND bulan_dibayar='$bln'");
			
			if($qbayar > 0){
				header('Location: ./admin.php?hlm=bayar');
				die();
			} else {
				echo 'ada ERROR dg query';
			}
		}
		
		//tampilkan data siswa
		$qsiswa = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
		list($nis,$nisn,$nama,$idprodi) = mysqli_fetch_array($qsiswa);
		
      echo '<div class="row">';
		echo '<div class="col-sm-9"><table class="table table-bordered">';
		echo '<tr><td colspan="2">Nomor Induk</td><td colspan="3">'.$nis.'</td>';
      echo '<td><a href="./cetak.php?nis='.$nis.'" target="_blank" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> cetak semua</a></td></tr>';
		echo '<tr><td colspan="2">Nama Siswa</td><td colspan="4">'.$nama.'</td></tr>';
      
		echo '<tr><td colspan="2">Pembayaran</td><td colspan="4">';
?>
<form class="form-inline" role="form" method="post" action="./admin.php?hlm=bayar">
  <input type="hidden" name="nis" value="<?php echo $nis; ?>">
  <input type="hidden" name="tgl" value="<?php echo date("Y-m-d"); ?>">
  <div class="form-group">
      <label class="sr-only" for="kls">Kelas</label>
	  <select name="kls" class="form-control" id="kls">
	  <?php
		$qkelas = mysqli_query($koneksi,"SELECT * FROM kelas");
		while(list($id,$kelas,$thn)=mysqli_fetch_array($qkelas)){
			echo '<option value="'.$kelas.'">'.$kelas.' ('.$thn.')</option>';
		}
	  ?>
	  </select>
  </div>
  <div class="form-group">
      <label class="sr-only" for="kls">SPP</label>
	  <select name="spp" class="form-control" id="kls">
	  <?php
		$qkelas = mysqli_query($koneksi,"SELECT * FROM spp");
		while(list($id,$tahun,$nominal)=mysqli_fetch_array($qkelas)){
			echo '<option value="'.$tahun.'">'.$tahun.' (Rp.'.$nominal.')</option>';
		}
	  ?>
	  </select>
  </div>
  <div class="form-group">
    <label class="sr-only" for="bln">Bulan</label>
	<select name="bln" id="bln" class="form-control">
	<?php
		for($i=1;$i<=12;$i++){
			$b = date('F',mktime(0,0,0,$i,10));
			echo '<option value="'.$b.'">'.$b.'</option>';
		}
	?>
	</select>
  </div>
  <div class="form-group">
    <label class="sr-only" for="bln">Tahun</label>
	<select name="thn" id="bln" class="form-control">
	<?php
		for($i=2000;$i<=2030;$i++){
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
	?>
	</select>
  </div>
  <div class="form-group">
	<label class="sr-only" for="jml">Jumlah</label>
	<div class="input-group">
		<div class="input-group-addon">Rp.</div>
		<input type="text" class="form-control" id="jml" name="jml" placeholder="Jumlah">
	</div>
  </div>
  <button type="submit" class="btn btn-default" name="submit" value="bayar">Bayar</button>
</form>
<?php
		echo '</td></tr>';
		echo '<tr class="info"><th width="50">No</th><th width="100">NISN</th><th>Bulan</th><th>Tahun</th><th>Tanggal Bayar</th><th>Jumlah</th>';
		echo '<th>Aksi</th>';
		echo '</tr>';
		
		//tampilkan histori pembayaran, jika ada
		$qbayar = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE nisn='$nis' ORDER BY tgl_bayar DESC");
		if(mysqli_num_rows($qbayar) > 0){
			$no = 1;
			while(list($id_pembayaran,$id_petugas,$kelas,$tgl,$bulan,$tahun,$id_spp,$jumlah) = mysqli_fetch_array($qbayar)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$kelas.'</td>';
				echo '<td>'.$bulan.'</td>';
				echo '<td>'.$tahun.'</td>';
				echo '<td>'.$tgl.'</td>';
				echo '<td>'.$jumlah.'</td><td>';
				
				if($no){
					echo '<a href="./admin.php?hlm=bayar&submit=hapus&kls='.$kelas.'&nis='.$nis.'&bln='.$bulan.'" class="btn btn-danger btn-xs">Hapus</a>';
				}
				echo '</td></tr>';
				
				$no++;
			}
		} else {
			echo '<tr><td colspan="6"><em>Belum ada data!</em></td></tr>';
		}
		echo '</table></div></div>';
		
	} else {
?>
<!-- form input nomor induk siswa -->
<form class="form-horizontal" role="form" method="post" action="./admin.php?hlm=bayar">
  <div class="form-group">
  	<?php 
  		$sql=mysqli_query($koneksi,"SELECT * FROM siswa");
  	?>
    <label for="nis" class="col-sm-2 control-label">NISN</label>
    <div class="col-sm-3">
      <select class="form-control" name="nis">
      	<?php while ($data=mysqli_fetch_assoc($sql)) {?>
      		<option value="<?php echo $data['nis'] ?>"><?php echo $data['nama']; ?></option>
      	<?php } ?>
      </select>
    </div>
     <button type="submit" name="submit" class="btn btn-default">Lanjut</button>
  </div>
</form>
<?php
	
}
?>