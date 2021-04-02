<?php
$host	= "localhost";	//alamat server, biasanya 'localhost' atau isi dengan alamat ip server mysql anda
$user	= "root";		//defaultnya 'root', sesuaikan dg konfigurasi server anda
$pass	= "";		//kosongkan jika tidak ada
$db		= "aplikasi_spp";	//isi dengan nama database

$koneksi=mysqli_connect($host, $user, $pass,$db) or die( "server database tidak ditemukan!");
?>