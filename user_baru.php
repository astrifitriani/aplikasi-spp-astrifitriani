<?php
if( empty( $_SESSION['iduser'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if(isset($_REQUEST['submit'])){
		//proses simpan user baru
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$fullname = $_REQUEST['fullname'];
		$level = $_REQUEST['level'];
		
		$sql = mysqli_query($koneksi,"INSERT INTO petugas VALUES('','$username','$password','$fullname','$level')");
		
		if($sql > 0){
			header('Location: admin.php?hlm=master');
			die();
		} else {
			echo '<div class="alert alert-warning" role="alert">ada ERROR dengan query!</div>';
		}
	} else {
		//form tambah user
?>
<h2>Tambah User Baru</h2><hr>
<form class="form-horizontal" method="post" action="admin.php?hlm=master&aksi=baru" role="form">
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-3">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <label for="fullname" class="col-sm-2 control-label">Fullname</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
    </div>
  </div>
  <div class="form-group">
    <label for="admin" class="col-sm-2 control-label">Level</label>
    <div class="col-sm-2">
      <select name="level" class="form-control" id="admin">
		<option value="admin">admin</option>
		<option value="petugas">petugas</option>
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