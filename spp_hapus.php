<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$id = $_REQUEST['id'];
		$sql = mysqli_query($koneksi,"DELETE FROM spp WHERE id_spp='$id'");
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=spp');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		$id = $_REQUEST['id'];
		$sql = mysqli_query($koneksi,"SELECT * FROM spp WHERE id_spp='$id'");
		list($id_spp,$tahun) = mysqli_fetch_array($sql);
		
		echo '<div class="alert alert-danger">Yakin akan menghapus Tahun Pelajaran: <strong>'.$tahun.'</strong><br><br>';
		echo '<a href="./admin.php?hlm=master&sub=spp&aksi=hapus&submit=ya&id='.$id.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master&sub=spp" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>