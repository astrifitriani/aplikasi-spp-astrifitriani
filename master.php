<?php
if( empty( $_SESSION['iduser'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['sub'] )){
		
		$sub = $_REQUEST['sub'];
		
		switch($sub){
			case 'jurusan':
				include 'jurusan.php';
				break;
			case 'siswa':
				include 'siswa.php';
				break;
			case 'kelas':
				include 'kelas.php';
				break;
			case 'jenis':
				include 'jenis.php';
				break;
			case 'spp':
				include 'spp.php';
				break;
		}
	} else {
		//tampilkan daftar user		
		if(isset($_REQUEST['aksi'])){
			$aksi = $_REQUEST['aksi'];
			
			switch($aksi){
				case 'baru':
					include 'user_baru.php';
					break;
				case 'edit':
					include 'user_edit.php';
					break;
				case 'hapus':
					include 'user_hapus.php';
					break;
			}
		} else {
			echo '<h2>Daftar User</h2><hr>';
			
			$sql = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY id_petugas");
			
			//diasumsikan bahwa selalu ada user, minimal user awal yaitu: admin dan kasir
			$no = 1;
         echo '<div class="row">';
         echo '<div class="col-md-6">';
			echo '<table class="table table-bordered">';
			echo '<tr class="success"><th width="30">No.</th><th>Username</th><th>Nama Lengkap</th><th width="50">level</th>';
			echo '<th><a href="admin.php?hlm=master&aksi=baru" class="btn btn-default btn-xs">Tambah</a></th></tr>';
			while(list($id,$username,$password,$nama_petugas,$level) = mysqli_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$username.'</td>';
				echo '<td>'.$nama_petugas.'</td>';
				echo '<td>';
				echo ($level == "admin") ? 'admin' : 'petugas';
				echo '</td>';
				echo '<td><a href="admin.php?hlm=master&aksi=edit&id='.$id.'" class="btn btn-success btn-xs">Edit</a> ';
				echo '<a href="admin.php?hlm=master&aksi=hapus&id='.$id.'" class="btn btn-danger btn-xs">Hapus</a></td></tr>';
				$no++;
			}
			echo '</table>';
         echo '</div></div>';
		}
	}
}
?>