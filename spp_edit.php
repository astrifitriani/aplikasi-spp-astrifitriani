<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$id= $_REQUEST['id'];
		$tahun = $_REQUEST['tahun'];
		$nominal = $_REQUEST['nominal'];
		
		$sql = mysqli_query($koneksi,"UPDATE spp SET  tahun='$tahun',nominal='$nominal' WHERE id_spp='$id'");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=spp');
			die();
		} else {
			echo 'ada ERROR dg query';
		}
	} else {
		$id= $_REQUEST['id'];
		$sql = mysqli_query($koneksi,"SELECT * FROM spp WHERE id_spp='$id'");
		list($id,$tahun,$nominal) = mysqli_fetch_array($sql);
?>
<h2>Edit Tahun Pelajaran</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=spp&aksi=edit" class="form-horizontal" role="form">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="form-group">
		<label for="spp" class="col-sm-2 control-label">Tahun Pelajaran</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="spp" name="tahun" value="<?php echo $tahun; ?>" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="spp" class="col-sm-2 control-label">Nominal</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="spp" name="nominal" value="<?php echo $nominal; ?>" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-4">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=spp" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>