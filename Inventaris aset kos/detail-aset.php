<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Proses Hapus Data (Delete)
if (isset($_POST['hapus'])) {
    mysqli_query($conn, "DELETE FROM aset WHERE id = $id");
    header("Location: kelola-aset.php");
    exit();
}

// Ambil data berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM aset WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Aset tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Aset Kos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Inventaris Aset Kos</h1>
  <p>
    <a href="kelola-aset.php">Kelola Aset</a>
  </p>

  <h2>Detail Aset</h2>
  <table>
    <tr>
      <td>Kode Aset</td>
      <td><?php echo $row['kode']; ?></td>
    </tr>
    <tr>
      <td>Nama Barang</td>
      <td><?php echo $row['nama_barang']; ?></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td><?php echo $row['kategori']; ?></td>
    </tr>
    <tr>
      <td>Merek</td>
      <td><?php echo $row['merek']; ?></td>
    </tr>
    <tr>
      <td>Jumlah Unit</td>
      <td><?php echo $row['jumlah']; ?></td>
    </tr>
    <tr>
      <td>Lokasi / Kamar</td>
      <td><?php echo $row['lokasi']; ?></td>
    </tr>
    <tr>
      <td>Kondisi Fisik</td>
      <td><?php echo $row['kondisi']; ?></td>
    </tr>
    <tr>
      <td>Tanggal Pengadaan</td>
      <td><?php echo $row['tanggal_pengadaan']; ?></td>
    </tr>
    <tr>
      <td>Catatan</td>
      <td><?php echo $row['catatan']; ?></td>
    </tr>
  </table>

  <br>

  <h2>Hapus Aset</h2>
  <p>Apakah kamu yakin ingin menghapus aset <?php echo $row['nama_barang']; ?> (<?php echo $row['kode']; ?>) dari daftar inventaris?</p>
  
  <form action="" method="post">
    <a href="kelola-aset.php">Batal</a>
    <button type="submit" name="hapus" style="background-color: red; color: white;">Ya, Hapus Aset</button>
  </form>

</body>
</html>