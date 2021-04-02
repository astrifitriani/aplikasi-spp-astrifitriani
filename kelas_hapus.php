<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($koneksi,"DELETE FROM kelas WHERE id_kelas='$nis'");
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=kelas');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_kelas='$nis'");
		list($nis,$nama,$kompetensi) = mysqli_fetch_array($sql);
		
		echo '<div class="alert alert-danger">Yakin akan menghapus kelas:';
		echo '<br>Nama  : <strong>'.$nama.'</strong>';
		echo '<br>NIS   : '.$nis;
		
		echo '<a href="./admin.php?hlm=master&sub=kelas&aksi=hapus&submit=ya&nis='.$nis.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master&sub=kelas" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>