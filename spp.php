<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'spp_baru.php';
				break;
			case 'edit':
				include 'spp_edit.php';
				break;
			case 'hapus':
				include 'spp_hapus.php';
				break;
		}
	} else {
		$sql = mysqli_query($koneksi,"SELECT * FROM spp ORDER BY id_spp DESC");
		echo '<h2>Pengaturan SPP</h2><hr>';
      echo '<div class="row">';
		echo '<div class="col-md-6"><table class="table table-bordered">';
		echo '<tr class="success"><th width="30">No</th><th width="100">Tahun Pelajaran</th><th width="100">Nominal</th>';
		echo '<th width="200"><a href="./admin.php?hlm=master&sub=spp&aksi=baru" class="btn btn-default btn-xs">Tambah Data</a></th></tr>';
		
		if( mysqli_num_rows($sql) > 0 ){
			$no = 1;
			while(list($id,$tahun,$nominal) = mysqli_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$tahun.'</td>';
				echo '<td>'.$nominal.'</td>';
				echo '<td><a href="./admin.php?hlm=master&sub=spp&aksi=edit&id='.$id.'" class="btn btn-success btn-xs">Edit</a> ';
				echo '<a href="./admin.php?hlm=master&sub=spp&aksi=hapus&id='.$id.'" class="btn btn-danger btn-xs">Hapus</a></td>';
				echo '</tr>';
				$no++;
			}
		} else {
			echo '<tr><td colspan="4"><em>Belum ada data</em></td></tr>';
		}
		
		echo '</table></div></div>';
	}
}
?>