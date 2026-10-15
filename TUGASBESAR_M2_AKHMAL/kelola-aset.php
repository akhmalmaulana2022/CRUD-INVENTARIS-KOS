<?php
include 'koneksi.php';

// Proses Simpan Data (Create)
if (isset($_POST['simpan'])) {
    $kode = "AST-" . rand(1000, 9999); // Generate kode unik otomatis
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = $_POST['kategori'];
    $merek = mysqli_real_escape_string($conn, $_POST['merek']);
    $jumlah = (int)$_POST['jumlah'];
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $kondisi = $_POST['kondisi'];
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO aset (kode, nama_barang, kategori, merek, jumlah, lokasi, kondisi, tanggal_pengadaan, catatan) 
              VALUES ('$kode', '$nama', '$kategori', '$merek', $jumlah, '$lokasi', '$kondisi', '$tanggal', '$catatan')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: kelola-aset.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Aset Kos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Inventaris Aset Kos</h1>
  <p>
    <a href="kelola-aset.php">Kelola Aset</a>
  </p>

  <h2>Daftar Aset</h2>
  <table>
    <tr>
      <th>Kode</th>
      <th>Nama Barang</th>
      <th>Kategori</th>
      <th>Merek</th>
      <th>Lokasi</th>
      <th>Jumlah</th>
      <th>Kondisi</th>
      <th>Aksi</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM aset");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['kode'] . "</td>";
        echo "<td>" . $row['nama_barang'] . "</td>";
        echo "<td>" . $row['kategori'] . "</td>";
        echo "<td>" . $row['merek'] . "</td>";
        echo "<td>" . $row['lokasi'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td>" . $row['kondisi'] . "</td>";
        echo "<td><a href='detail-aset.php?id=" . $row['id'] . "'>Lihat</a></td>";
        echo "</tr>";
    }
    ?>
  </table>

  <h2>Tambah Aset Baru</h2>
  <form action="" method="post">
    <label for="nama">Nama Barang</label>
    <input type="text" id="nama" name="nama" required>

    <label for="kategori">Kategori</label>
    <select id="kategori" name="kategori">
      <option value="Elektronik">Elektronik</option>
      <option value="Furnitur">Furnitur</option>
      <option value="Lainnya">Lainnya</option>
    </select>

    <label for="merek">Merek</label>
    <input type="text" id="merek" name="merek">

    <label for="jumlah">Jumlah Unit</label>
    <input type="number" id="jumlah" name="jumlah" min="1" value="1" required>

    <label for="lokasi">Lokasi / Kamar</label>
    <input type="text" id="lokasi" name="lokasi">

    <label for="kondisi">Kondisi Fisik</label>
    <select id="kondisi" name="kondisi">
      <option value="Baik">Baik</option>
      <option value="Cukup">Cukup</option>
      <option value="Rusak">Rusak</option>
    </select>

    <label for="catatan">Catatan</label>
    <textarea id="catatan" name="catatan" rows="3"></textarea>

    <button type="submit" name="simpan">Simpan Aset</button>
  </form>

</body>
</html>