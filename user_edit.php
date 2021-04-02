<?php
if( empty( $_SESSION['iduser'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if(isset($_REQUEST['submit'])){
		//proses update data user: username, password, status admin, fullname
		$iduser = $_REQUEST['iduser'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$fullname = $_REQUEST['fullname'];
		$admin = $_REQUEST['admin'];
		
		$query = "UPDATE petugas SET username='$username',password='$password',level='$admin',fullname='$fullname' WHERE id_petugas='$iduser'";
		
		
		if( mysqli_query($koneksi,$query)){
			header('Location: admin.php?hlm=master');
			die();
		} else {
			echo '<div class="alert alert-warning" role="alert">ada ERROR dengan query!</div>';
		}
		
		
	} else {
		//form edit data user terpilih
		$id = $_REQUEST['id'];
		
		$sql = mysqli_query($koneksi,"SELECT * FROM petugas WHERE id_petugas='$id'");
		list($iduser,$username,$password,$fullname,$admin) = mysqli_fetch_array($sql);
?>
<h2>Edit User</h2><hr>
<form class="form-horizontal" method="post" action="admin.php?hlm=master&aksi=edit" role="form">
  <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required autofocus>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-3">
      <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="fullname" class="col-sm-2 control-label">Fullname</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullname; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="admin" class="col-sm-2 control-label">Admin</label>
    <div class="col-sm-2">
      <select name="admin" class="form-control" id="admin">
		<option value="admin" <?php echo ($admin=='admin') ? 'selected':''; ?>>Admin</option>
		<option value="petugas" <?php echo ($admin=='petugas') ? 'selected':''; ?>>Petugas</option>
	  </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Simpan</button>
	  <a href="admin.php?hlm=master" class="btn btn-link">Batal</a>
    </div>
  </div>
 </form>
<?php
	}
}
?>