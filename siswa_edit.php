<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nisn=$_REQUEST['nisn'];
		$nis = $_REQUEST['nis'];
		$nama = $_REQUEST['nama'];
		$alamat = $_REQUEST['alamat'];
		$no_telp = $_REQUEST['no_telp'];
		$idspp = $_REQUEST['idspp'];
		$idkelas = $_REQUEST['idkelas'];
		$sql = mysqli_query($koneksi,"UPDATE siswa SET nisn='$nisn', nis='$nis', nama='$nama', alamat='$alamat', no_telp='$no_telp' ");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=siswa');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nisn='$nis'");
		list($nisn,$nis,$nama,$idkelas,$alamat,$no_telp,$spp) = mysqli_fetch_array($sql);
?>
<h2>Edit Data Siswa</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=siswa&aksi=edit" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="nis" class="col-sm-2 control-label">NISN</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="nis" name="nisn" placeholder="NISN" value="<?php echo $nisn ?>" >
		</div>
	</div>
	<div class="form-group">
		<label for="nis" class="col-sm-2 control-label">NIS</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="nis" name="nis" placeholder="NIS" value="<?php echo $nis ?>" >
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama siswa</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?php echo $nama ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">Kelas</label>
		<div class="col-sm-4">
			<select name="idkelas" class="form-control">
			<?php
			$qprodi = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY id_kelas");
			while(list($id,$kelas)=mysqli_fetch_array($qprodi)){
				echo '<option value="'.$id.'"';
				echo ($id==$kelas) ? 'selected' : '';
				echo '>'.$kelas.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">Alamat</label>
		<div class="col-sm-4">
			<textarea class="form-control" name="alamat"><?php echo $alamat; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">No Telepon</label>
		<div class="col-sm-4">
			<input type="text" name="no_telp" class="form-control" value="<?php echo $no_telp ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">SPP</label>
		<div class="col-sm-4">
			<select name="idspp" class="form-control">
			<?php
			$qprodi = mysqli_query($koneksi,"SELECT * FROM spp ORDER BY id_spp");
			while(list($id,$nama)=mysqli_fetch_array($qprodi)){
				echo '<option value="'.$id.'">'.$nama.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=siswa" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>