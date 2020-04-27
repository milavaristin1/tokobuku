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
     <nav class="navbar navbar-expand-md bg-dark navbar-dark stiky-top">
      <a href="#">
        <img src="buku1.png" width="150" alt="">
      </a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <!-- dibuang saja yg ga perlu -->
          <li class="nav-item"> <a href="list_buku.php" class="nav-link">Buku</a></li>
          <li class="nav-item"> <a href="cart.php" class="nav-link">Cart</a></li>
          <!-- ini tampilan customer, menu nya jgn samakan spt admin miiiil apa aja pak puny saya yng customer gitu -->
          <li class="nav-item"> <a href="transaksi.php" class="nav-link">Transaksi</a></li>
          <li class="nav-item">
          <a class="nav-link" href="proses_login_customer.php?logout=true">
            <?php echo $_SESSION["nama"]; ?> | logout
          </a>
          </li>
        </ul>
      </div>
      </nav>
      <!-- admin ga perlu ada cart ini yang customer pak-->

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
           on t.id_customer = c.id_customer
           where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
           $mboh = mysqli_query($connect, $sql);

            ?>


          <ul class= "list-group">
          <?php foreach($mboh as $transaksi): ?>
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
