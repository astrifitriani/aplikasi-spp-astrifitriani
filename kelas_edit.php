<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$id_kelas=$_REQUEST['id'];
		$nama = $_REQUEST['nama'];
		$kompetensi = $_REQUEST['kompetensi'];
		
		$sql = mysqli_query($koneksi,"UPDATE kelas SET nama_kelas='$nama', kompetensi_keahlian='$kompetensi' WHERE id_kelas='$id_kelas'");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=kelas');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_kelas='$nis'");
		list($nis,$nama,$kompetensi) = mysqli_fetch_array($sql);
?>
<h2>Edit Data Kelas</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=kelas&aksi=edit" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="nis" class="col-sm-2 control-label">Id</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="nis" name="id" value="<?php echo $nis; ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama kelas</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">Kompetensi Keahlian</label>
		<div class="col-sm-4">
			<input type="" name="kompetensi" class="form-control" value="<?php echo $kompetensi ?>">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=kelas" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>