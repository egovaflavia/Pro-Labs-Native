<?php include 'conn.php'; ?>
<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Ujian Labor</title>
</head>

<body>
     <center>
          <h2>Kamar</h2>
          <h4>Data Kamar</h4>
          <table border="1">
               <tr>
                    <th>No Faktur</th>
                    <th>No Kamar</th>
                    <th>No Id</th>
                    <th>Tgl Masuk</th>
                    <th>Tgl Keluar</th>
                    <th>Biaya Adm</th>
               </tr>
               <?php
               $ambil = $conn->query("SELECT * FROM transaksi1");
               while ($pecah = $ambil->fetch_object()) :
               ?>
                    <tr>
                         <td><?php echo $pecah->no_faktur ?></td>
                         <td><?php echo $pecah->no_kamar ?></td>
                         <td><?php echo $pecah->no_id ?></td>
                         <td><?php echo $pecah->tgl_masuk ?></td>
                         <td><?php echo $pecah->tgl_keluar ?></td>
                         <td><?php echo $pecah->biaya_adm ?></td>
                    </tr>
               <?php endwhile ?>
          </table>
     </center>

</body>

</html>