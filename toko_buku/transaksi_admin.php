<?php
session_start();
// menambah barang ke cart
if (!isset($_SESSION["id_admin"])) {
  header("location:login_admin.php");
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
     .bg-navy{
       background: pink;
     }
     .img{
       width:50px;
       height:100px;
     }

     </style>
   </head>
   <body>
     <nav class="navbar navbar-expand-md bg-navy navbar-dark stiky-top">
      <a href="#">
        <img src="buku1.png" width="150" alt="">
      </a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <li class="nav-item"> <a href="#a" class="nav-link">Menu</a></li>
          <li class="nav-item"> <a href="buku.php" class="nav-link">Buku</a></li>
          <li class="nav-item"> <a href="admin.php" class="nav-link">Admin</a></li>
          <li class="nav-item"> <a href="customer.php" class="nav-link">Customer</a></li>
          <li class="nav-item"> <a href="transaksi_admin.php" class="nav-link">Transaksi </a></li>
          <li class="nav-item">
          <a class="nav-link" href="proses_login_admin.php?logout=true">
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
       <div class="card mt-3">
         <div class="card-header bg-secondary">
           <h4 class = "text-white">Riwayat Transaksi</h4>
         </div>
         <div class="card-body">
           <?php
           $sql = "select * from transaksi t inner join customer c
           on t.id_customer = c.id_customer";
           $query = mysqli_query($connect, $sql);
            ?>


          <ul class= "list-group">
          <?php foreach ($query as $transaksi):?>
            <li class="list-group-item mb-4">
          <h6> ID Transaksi <?php echo $transaksi["id_transaksi"]; ?></h6>
          <h6> Nama Pembeli <?php echo $transaksi["nama"]; ?></h6>
          <h6> Tgl. Transaksi <?php echo $transaksi["tgl"]; ?></h6>
          <h6> List Barang:</H6>


          <?php
          $sql2 = "select * from detail_transaksi d inner join buku b
          on d.kode_buku = b.kode_buku
          where d.id_transaksi= '".$transaksi["id_transaksi"]."'";
          $query2 = mysqli_query($connect, $sql2);
          ?>

          <table class="table table-borderless">
          <thead>
          <tr>
          <th>Judul</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
          </tr>
          </thead>
          <tbody>
          <?php $total = 0; foreach ($query2 as $detail): ?>
          <tr>
          <td><?php echo $detail["judul"]; ?></td>
          <td><?php echo $detail["jumlah"]; ?></td>
          <td><?php echo number_format($detail["harga"]); ?></td>
          <td>
          Rp <?php echo number_format($detail["harga"]*$detail["jumlah"]); ?>
          </td>
          </tr>
          <?php
          $total += ($detail["harga_beli"]*$detail["jumlah"]);
                     endforeach; ?>
                    </tbody>
                  </table>
                  <h6 class="text-danger">Rp <?php echo number_format($total); ?></h6>
               <?php endforeach; ?>
             </ul>
          </div>
        </div>
      </div>




          </li>

   </body>
 </html>
