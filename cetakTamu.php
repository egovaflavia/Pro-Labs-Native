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
          <h2>Laporan Data</h2>
          <h4>Data tamu</h4>
          <table border="1">
               <tr>
                    <th>Id Tamu</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Asal</th>
                    <th>No Tlp</th>
               </tr>
               <?php
               $ambil = $conn->query("SELECT * FROM tamu");
               while ($pecah = $ambil->fetch_object()) :
               ?>
                    <tr>
                         <td><?php echo $pecah->no_id ?></td>
                         <td><?php echo $pecah->nama ?></td>
                         <td><?php echo $pecah->alamat ?></td>
                         <td><?php echo $pecah->asal ?></td>
                         <td><?php echo $pecah->asal ?></td>
                    </tr>
               <?php endwhile ?>
               <?php
               if (isset($_GET['hapus_no_id'])) {
                    $hapus = $conn->query("DELETE FROM tamu WHERE no_id = '$_GET[hapus_no_id]'");

                    if ($hapus) {
                         echo "
                              <script>
                              alert('Data di Hapus');
                              window.location='tamu.php'
                              </script>
                              ";
                    }
               }
               ?>
          </table>
     </center>

</body>

</html>