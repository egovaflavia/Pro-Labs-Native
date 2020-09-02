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
          <h2>Kamar</h2>
          <h4>Data Kamar</h4>
          <table border="1">
               <tr>
                    <th>No Kamar</th>
                    <th>Jenis</th>
                    <th>Type</th>
                    <th>Tarif</th>
                    <th>Aksi</th>
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
                         <td width="130px">
                              <a href="kamar.php?edit_no_kamar=<?php echo $pecah->no_kamar ?>" class="btn btn-sm btn-warning">Edit</a>
                              <a href="kamar.php?hapus_no_kamar=<?php echo $pecah->no_kamar ?>" class="btn btn-sm btn-danger">Hapus</a>
                         </td>
                    </tr>
               <?php endwhile ?>
               <?php
               if (isset($_GET['hapus_no_kamar'])) {
                    $hapus = $conn->query("DELETE FROM kamar WHERE no_kamar = '$_GET[hapus_no_kamar]'");

                    if ($hapus) {
                         echo "
                              <script>
                              alert('Data di Hapus');
                              window.location='kamar.php'
                              </script>
                              ";
                    }
               }
               ?>
          </table>

          <hr>
          <?php
          if (isset($_GET['edit_no_kamar'])) { ?>
               <?php
               $no_kamar = $_GET['edit_no_kamar'];
               $ambil = $conn->query("SELECT * FROM kamar WHERE no_kamar = '$no_kamar'");
               while ($pecah = $ambil->fetch_object()) {
               ?>
                    <form action="" method="POST">
                         <div class="form-group">
                              <label>No Kamar</label>
                              <input value="<?= $pecah->no_kamar ?>" type="text" name="no_kamar">
                         </div>
                         <div class="form-group">
                              <label>Jenis</label>
                              <select name="jenis" id="">
                                   <option value="Ekonomi">Ekonomi</option>
                                   <option value="VIP">VIP</option>
                                   <option value="VVIP">VVIP</option>
                              </select>
                         </div>
                         <div class="form-group">
                              <label>Type</label>
                              <select name="tipe" id="">
                                   <option value="Mawar">Mawar</option>
                                   <option value="Melati">Melati</option>
                                   <option value="Anggrek">Anggrek</option>
                              </select>
                         </div>
                         <div class="form-group">
                              <label>Tarif</label>
                              <input value="<?= $pecah->tarif ?>" type="number" name="tarif">
                         </div>
                         <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                    </form>
               <?php } ?>
               <?php
               if (isset($_POST['edit'])) {
                    $edit = $conn->query(" UPDATE `kamar` 
                                                            SET 
                                                            `no_kamar`='$_POST[no_kamar]',
                                                            `jenis`='$_POST[jenis]',
                                                            `type`='$_POST[tipe]',
                                                            `tarif`='$_POST[tarif]'
                                                            WHERE 
                                                            `no_kamar`='$_GET[edit_no_kamar]'");

                    if ($edit) {
                         echo "
                              <script>
                              alert('Data di Edit');
                              window.location='kamar.php'
                              </script>
                              ";
                    }
               }
               ?>
          <?php } else { ?>
               <form action="" method="POST">
                    <div class="form-group">
                         <label>No Kamar</label>
                         <input type="text" name="no_kamar">
                    </div>
                    <div class="form-group">
                         <label>Jenis</label>
                         <select name="jenis" id="">
                              <option value="Ekonomi">Ekonomi</option>
                              <option value="VIP">VIP</option>
                              <option value="VVIP">VVIP</option>
                         </select>
                    </div>
                    <div class="form-group">
                         <label>Type</label>
                         <select name="tipe" id="">
                              <option value="Mawar">Mawar</option>
                              <option value="Melati">Melati</option>
                              <option value="Anggrek">Anggrek</option>
                         </select>
                    </div>
                    <div class="form-group">
                         <label>Tarif</label>
                         <input type="number" name="tarif">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
               </form>
               <?php
               if (isset($_POST['simpan'])) {
                    $simpan = $conn->query("INSERT INTO `kamar`(`no_kamar`, `jenis`, `type`, `tarif`) VALUES ('$_POST[no_kamar]', '$_POST[jenis]','$_POST[tipe]','$_POST[tarif]')");

                    if ($simpan) {
                         echo "
                              <script>
                              alert('Data di Simpan');
                              window.location='kamar.php'
                              </script>
                              ";
                    }
               }
               ?>
          <?php } ?>

</body>

</html>