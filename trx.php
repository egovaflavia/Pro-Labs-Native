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
          <h2>Transaksi</h2>
          <h4>Data Transaksi</h4>
          <table border="1">
               <tr>
                    <th>No Faktur</th>
                    <th>No Kamar</th>
                    <th>No Id</th>
                    <th>Tgl Masuk</th>
                    <th>Tgl Keluar</th>
                    <th>Biaya Adm</th>
                    <th>Aksi</th>
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
                         <td>
                              <a href="trx.php?hapus_no_faktur=<?php echo $pecah->no_faktur ?>" class="btn btn-sm btn-danger">Hapus</a>
                         </td>
                    </tr>
               <?php endwhile ?>
               <?php
               if (isset($_GET['hapus_no_faktur'])) {
                    $hapus = $conn->query("DELETE FROM transaksi1 WHERE no_faktur = '$_GET[hapus_no_faktur]'");

                    if ($hapus) {
                         echo "
                              <script>
                              alert('Data di Hapus');
                              window.location='trx.php'
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
                              <input value="<?= $pecah->no_kamar ?>" type="text" name="no_faktur">
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
                              window.location='trx.php'
                              </script>
                              ";
                    }
               }
               ?>
          <?php } else { ?>
               <form action="" method="POST">
                    <div class="form-group">
                         <label>No Faktur</label>
                         <input type="text" name="no_faktur">
                    </div>
                    <div class="form-group">
                         <label>No kamar</label>
                         <select name="no_kamar" id="">
                              <?php
                              $ambil2 = $conn->query("SELECT * FROM kamar");
                              while ($pecah2 = $ambil2->fetch_object()) :
                              ?>
                                   <option value="<?= $pecah2->no_kamar ?>"><?= $pecah2->no_kamar ?></option>
                              <?php endwhile ?>
                         </select>
                    </div>
                    <div class="form-group">
                         <label>No Id</label>
                         <select name="no_id" id="">
                              <?php
                              $ambil2 = $conn->query("SELECT * FROM tamu");
                              while ($pecah2 = $ambil2->fetch_object()) :
                              ?>
                                   <option value="<?= $pecah2->no_id ?>"><?= $pecah2->no_id ?></option>
                              <?php endwhile ?>
                         </select>
                    </div>
                    <div class="form-group">
                         <label>Tgl Masuk</label>
                         <input type="date" name="masuk">
                    </div>
                    <div class="form-group">
                         <label>Tgl Keluar</label>
                         <input type="date" name="keluar">
                    </div>
                    <div class="form-group">
                         <label>Adm</label>
                         <input type="number" name="adm">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
               </form>
               <?php
               if (isset($_POST['simpan'])) {
                    $simpan = $conn->query("INSERT INTO `transaksi1`(`no_faktur`, `no_kamar`, `no_id`, `tgl_masuk`, `tgl_keluar`, `biaya_adm`) VALUES ('$_POST[no_faktur]', '$_POST[no_kamar]','$_POST[no_id]','$_POST[masuk]','$_POST[keluar]','$_POST[adm]')");

                    if ($simpan) {
                         echo "
                              <script>
                              alert('Data di Simpan');
                              window.location='trx.php'
                              </script>
                              ";
                    }
               }
               ?>
          <?php } ?>

</body>

</html>