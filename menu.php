<?php
    session_start();
      if (!isset($_SESSION['login'])) {
        echo "<script type='text/javascript'>location.href='index.php'</script>";
      }

      else{
        if (isset($_SESSION['username'])) {
            $username= $_SESSION['username'];
            $id_user= $_SESSION['iduser'];
            $nama_petugas= $_SESSION['nama_petugas'];
            $level=$_SESSION['level'];
            require 'koneksi.php';
        }
      }
?>
<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #000;">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	</div>
	<?php if ($level=="admin"): ?>
		<div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li><a href="./admin.php">Beranda</a></li>
			<li><a href="./admin.php?hlm=bayar">Pembayaran</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan<b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="./admin.php?hlm=laporan">Rekap Pembayaran</a></li>
				<li><a href="./admin.php?hlm=laporan&sub=tagihan">Cetak Tagihan</a></li>
			  </ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data<b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="./admin.php?hlm=master&sub=siswa">Siswa</a></li>
				<li><a href="./admin.php?hlm=master&sub=kelas">Kelas</a></li>
				<li><a href="./admin.php?hlm=master">Petugas</a></li>
				<li><a href="./admin.php?hlm=master&sub=spp">SPP</a></li>
			  </ul>
			</li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li class="dropdown active">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo $nama_petugas; ?> <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu">
				<li><a href="./admin.php?hlm=user">Profil</a></li>
				<li><a href="./admin.php?hlm=user&sub=pass">Ganti Password</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!--/.nav-collapse -->	
	<?php endif ?>

	<?php if ($level=="petugas"): ?>
		<div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li><a href="./admin.php">Home</a></li>
			<li><a href="./admin.php?hlm=bayar">Pembayaran</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="./admin.php?hlm=laporan&sub=tagihan">Cetak Tagihan</a></li>
			  </ul>
			</li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li class="dropdown active">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo $nama_petugas; ?> <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu">
				<li><a href="./admin.php?hlm=user">Profil</a></li>
				<li><a href="./admin.php?hlm=user&sub=pass">Ganti Password</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!--/.nav-collapse -->	
	<?php endif ?>

	<?php if ($level=="siswa"): ?>
		<div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li><a href="./admin.php">Home</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="./admin.php?hlm=laporan&sub=tagihan">Cetak Tagihan</a></li>
			  </ul>
			</li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li class="dropdown active">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo $nama_petugas; ?> <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu">
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!--/.nav-collapse -->	
	<?php endif ?>
	
  </div>
</div>
