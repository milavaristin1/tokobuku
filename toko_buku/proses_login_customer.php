<?php
session_start();
// session_start() digunakan sebagai tanda kalau kita akan menggunakan session pada halaman ini
// session_start() harus diletakkan pada baris pertama
include("config.php");

//tampung data username dan password nya


if (isset($_POST["login_customer"]))
$username = $_POST["username"];
$password = $_POST["password"];
  $sql = "select * from customer where username ='$username' and password = '$password'";
  //eksekusi query
  $query = mysqli_query($connect, $sql);
  $jumlah = mysqli_num_rows($query);
  // mysqli_num_rows digunakan untuk menghitung jumlah data hasil dari query

  if ($jumlah > 0) {
    // jika jumlahnya lebih dari nol, artinya terdapat data admin yang sesuai dengan username dan password yang ditampilkan
   // ini blok jika login berhasil
   // kita ubah hasil query ke array
   $customer = mysqli_fetch_array($query);

   // membuat session
   $_SESSION["id_customer"] = $customer["id_customer"];
   $_SESSION["nama"] = $customer["nama"];
   $_SESSION["cart"] = array();
   header("location:list_buku.php");
  }else{
    // jika jumlahnya nol, artinya tidak ada data admin yang sesuai dengan username dan password yg diinputkan
   // ini blok kode jika loginnya gagal / salah
   header("location:login_customer.php");
 }

   if(isset($_GET["logout"])) {
     // proses logout

     session_destory(); // menghapus data session yang telah dibuat
     header("location:login_customer.php");
   }


 ?>
