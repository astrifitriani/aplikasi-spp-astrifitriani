<?php
require 'koneksi.php';
if( isset( $_POST['submit'] ) ){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password'");
		$data=mysqli_fetch_assoc($sql);
		
		if( mysqli_num_rows($sql) > 0 ){
			session_id('masuk');
                            session_start();
                            $_SESSION['login']      = TRUE;
                            $_SESSION['iduser']		=$data['id_petugas'];
                            $_SESSION['nama_petugas']    = $data['nama_petugas'];
                            $_SESSION['username']   = $data['username'];
                            $_SESSION['level']		=$data['level'];
			header("Location: ./admin.php");
		} else {
			//$err = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
			//header('Location: ./?err='.urlencode($err));
			
			$_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
			header('Location: ./');
			die();
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Aplikasi SPP</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	body {
	padding-top: 40px;
	padding-bottom: 40px;
	background: linear-gradient(45deg,#bbb,#fff);
	background-size: 100% 100vh;
	}

	.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
	color: #006666;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	margin-bottom: 10px;
	text-align: center;
	}
	.form-signin .checkbox {
	  font-weight: normal;
	}
	.form-signin .form-control {
	  position: relative;
	  height: auto;
	  -webkit-box-sizing: border-box;
		 -moz-box-sizing: border-box;
			  box-sizing: border-box;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
	.form-signin input[type="text"] {
	  margin-bottom: -1px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	}
	.form-signin input[type="password"] {
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
	</style>
	
</head>

  <body>

    <div class="container" >
    	<br><br><br><br><br><br><br>
      <form class="form-signin" style="background-color: white; border-radius: 10px;" method="post" action="">
		<?php
		if(isset($_SESSION['err'])){
			$err = $_SESSION['err'];
			echo '<div class="alert alert-warning alert-message">'.$err.'</div>';
		}
		?>
        <h3 class="form-signin-heading text-info"><strong>ADMIN</strong></h3>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <br>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-success col-md-12" type="submit" name="submit">Login</button>
        <a href="index.php" class="btn btn-lg btn-warning col-md-12">Siswa</a>
        <p>&nbsp;</p>
      </form>

    </div> <!-- /container -->
	
	<!-- Bootstrap core JavaScript, Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(".alert-message").alert().delay(3000).slideUp('slow');
	</script>
  </body>
</html>