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
     <ul>
          <li>
               <a href="index.php">Home</a>
          </li>
          <li>
               <a href="tamu.php">Tamu</a>
          </li>
          <li>
               <a href="kamar.php">Kamar</a>
          </li>
          <li>
               <a href="trx.php">Transaksi</a>
          </li>
          <li>
               <a href="cetakTamu.php">Laporan Tamu</a>
          </li>
          <li>
               <a href="cetakKamar.php">Laporan Kamar</a>
          </li>
          <li>
               <a href="cetakTrx.php">Laporan Transaksi</a>
          </li>
     </ul>

     <div>
          <h2>tamu</h2>
          <h4>Data tamu</h4>
          <table border="1">
               <tr>
                    <th>Id Tamu</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Asal</th>
                    <th>No Tlp</th>
                    <th>Aksi</th>
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
                         <td width="130px">
                              <a href="tamu.php?edit_no_id=<?php echo $pecah->no_id ?>" class="btn btn-sm btn-warning">Edit</a>
                              <a href="tamu.php?hapus_no_id=<?php echo $pecah->no_id ?>" class="btn btn-sm btn-danger">Hapus</a>
                         </td>
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

          <hr>
          <?php
          if (isset($_GET['edit_no_id'])) { ?>
               <?php
               $no_id = $_GET['edit_no_id'];
               $ambil = $conn->query("SELECT * FROM tamu WHERE no_id = '$no_id'");
               while ($pecah = $ambil->fetch_object()) {
               ?>
                    <form action="" method="POST">
                         <div class="form-group">
                              <label>No Id</label>
                              <input value="<?= $pecah->no_id ?>" type="text" name="no_id">
                         </div>
                         <div class="form-group">
                              <label>Nama Tamu</label>
                              <input value="<?= $pecah->nama ?>" type="text" name="nama">
                         </div>
                         <div class="form-group">
                              <label>Alamat</label>
                              <textarea name="alamat" cols="30" rows="3"><?= $pecah->alamat ?></textarea>
                         </div>
                         <div class="form-group">
                              <label>Asal</label>
                              <input value="<?= $pecah->asal ?>" type="text" name="asal">
                         </div>
                         <div class="form-group">
                              <label>No Tlp</label>
                              <input value="<?= $pecah->notlp ?>" type="number" name="tlp">
                         </div>
                         <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                    </form>
               <?php } ?>
               <?php
               if (isset($_POST['edit'])) {
                    $edit = $conn->query(" UPDATE `tamu` 
                                                            SET 
                                                            `no_id`='$_POST[no_id]',
                                                            `nama`='$_POST[nama]',
                                                            `alamat`='$_POST[alamat]',
                                                            `asal`='$_POST[asal]',
                                                            `notlp`='$_POST[tlp]'
                                                            WHERE 
                                                            `no_id`='$_GET[edit_no_id]'");

                    if ($edit) {
                         echo "
                              <script>
                              alert('Data di Edit');
                              window.location='tamu.php'
                              </script>
                              ";
                    }
               }
               ?>
          <?php } else { ?>
               <form action="" method="POST">
                    <div class="form-group">
                         <label>No Id</label>
                         <input type="text" name="no_id">
                    </div>
                    <div class="form-group">
                         <label>Nama Tamu</label>
                         <input type="text" name="nama">
                    </div>
                    <div class="form-group">
                         <label>Alamat</label>
                         <textarea name="alamat" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                         <label>Asal</label>
                         <input type="text" name="asal">
                    </div>
                    <div class="form-group">
                         <label>No Tlp</label>
                         <input type="number" name="tlp">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
               </form>
               <?php
               if (isset($_POST['simpan'])) {
                    $simpan = $conn->query("INSERT INTO `tamu`(`no_id`, `nama`, `alamat`, `asal`, `notlp`) VALUES ('$_POST[no_id]', '$_POST[nama]','$_POST[alamat]','$_POST[asal]','$_POST[tlp]')");

                    if ($simpan) {
                         echo "
                              <script>
                              alert('Data di Simpan');
                              window.location='tamu.php'
                              </script>
                              ";
                    }
               }
               ?>
          <?php } ?>

</body>

</html>