<?php
session_start();
// menambah barang ke cart
if (!isset($_SESSION["id_customer"])) {
  header("location:login_customer.php");
}
include("config.php")
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>daftar buku</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <script type="text/javascript.min.js"></script>
     <script type="text/propper.min.js"></script>
     <script type="text/bootstrap.min.js"></script>
     <script type="text/javascript">
       Detail = (item) =>{
         document.getElementById('kode_buku').value = item.kode_buku;
         document.getElementById('judul').innerHTML = item.judul;
         document.getElementById('penulis').innerHTML = item.penulis;
         document.getElementById('harga').innerHTML = item.harga;
         document.getElementById('stok').innerHTML = item.stok;
         document.getElementById('jumlah_beli').value = "1";

         document.getElementById("image").src = "image/" + item.image;
       }
     </script>
     <style media="screen">
     .image{
       width:292px;
       height:192px;
     }
     .img{
       width:50px;
       height:100px;
     }
     </style>
   </head>
   <body>
     <nav class="navbar navbar-expand-md bg-dark navbar-light text-light stiky-top">
      <a href="#">
        <img src="image/logo.png" width="100" alt=""> <!--file buku1.png ndi? salah iku koyoe kabeh logo.png ae-->
      </a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <li class="nav-item"> <a href="#a" class="nav-link" style="color: white;">Menu</a></li>
          <li class="nav-item"> <a href="list_buku.php" class="nav-link" style="color: white;">List Buku</a></li>
          <li class="nav-item">
            <a href="cart.php" class="nav-link" style="color: white;">Cart(<?php echo count($_SESSION["cart"]); ?>)</a>
          </li>
          <li class="nav-item"> <a href="transaksi.php" class="nav-link" style="color: white;">Transaksi</a></li>
          <li class="nav-item">
          <a class="nav-link" href="proses_login_customer.php?logout=true" style="color: white;">
            <?php echo $_SESSION["nama"]; ?> | logout
          </a>
        </li>
        </ul>
      </div>
      </nav>



     <!-- start navigasi -->
     <!-- nanti tambah navigasi di sini -->
     <!-- end navigasi -->

    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <h4 class="text-white">Keranjang Belanja Anda</h4>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>judul</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>option</th>

              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($_SESSION["cart"] as $cart): ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $cart["judul"]; ?></td>
                <td><?php echo $cart["harga"]; ?></td>
                <td><?php echo $cart["jumlah_beli"]; ?></td>
                <td>Rp<?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                <td>
                <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"];?>"
                  onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                  <button type="button" class="btn btn-sm btn-primary">
                  hapus
                </button>
                </a>
                </td>
              </tr>

              <?php $no++; endforeach; ?>
            </tbody>
            <tfoot>
              <a href="proses_cart.php?checkout=true">
                <button type="button" class="btn btn-succes">
                  Checkout
                </button>
              </a>
            </tfoot>
          </table>
        </div>

      </div>

    </div>
   </body>
 </html>
