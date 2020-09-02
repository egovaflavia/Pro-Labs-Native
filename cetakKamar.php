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
                    <th>No Kamar</th>
                    <th>Jenis</th>
                    <th>Type</th>
                    <th>Tarif</th>
               </tr>
               <?php
               $ambil = $conn->query("SELECT * FROM kamar");
               while ($pecah = $ambil->fetch_object()) :
               ?>
                    <tr>
                         <td><?php echo $pecah->no_kamar ?></td>
                         <td><?php echo $pecah->jenis ?></td>
                         <td><?php echo $pecah->type ?></td>
                         <td><?php echo $pecah->tarif ?></td>
                    </tr>
               <?php endwhile ?>
          </table>
     </center>
</body>

</html>