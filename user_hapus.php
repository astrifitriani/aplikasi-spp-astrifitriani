<?php
if( empty( $_SESSION['iduser'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if(isset($_REQUEST['submit'])){
		$id = $_REQUEST['id'];
		$sql = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='$id'");
		
		if($sql > 0){
			header('Location: admin.php?hlm=master');
			die();
		} else {
			echo '<div class="alert alert-warning" role="alert">ada ERROR dengan query!</div>';
		}
	} else {
		//tampilkan konfirmasi hapus user
		$id = $_REQUEST['id'];
		$sql = mysqli_query($koneksi,"SELECT username,nama_petugas FROM petugas WHERE id_petugas='$id'");
		list($username,$nama_petugas) = mysqli_fetch_array($sql);
		
		echo '<div class="alert alert-danger">Yakin akan menghapus User: <strong>'.$nama_petugas.' ('.$username.')</strong> ?<br><br>';
		echo '<a href="./admin.php?hlm=master&aksi=hapus&submit=ya&id='.$id.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>