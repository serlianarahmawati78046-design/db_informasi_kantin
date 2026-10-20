<?php
include 'koneksi.php';

// Proses Simpan Data Pelanggan
if (isset($_POST['simpan_pelanggan'])) {
    $nis         = $_POST['nis'];
    $nama_siswa  = $_POST['nama_siswa'];
    $kelas       = $_POST['kelas'];
    $no_whatsapp = $_POST['no_whatsapp'];

    $query = "INSERT INTO tblpelanggankantin (NIS, nama_siswa, kelas, no_whatsapp) 
              VALUES ('$nis', '$nama_siswa', '$kelas', '$no_whatsapp')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Pelanggan Berhasil Disimpan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Kantin Sekolah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f6f9; }
        h2, h3 { color: #333; }
        .container { display: flex; gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        form input, form select, form button { display: block; width: 100%; margin-bottom: 12px; padding: 8px; box-sizing: border-box; }
        button { background-color: #ff35d3; color: white; border: none; cursor: pointer; border-radius: 4px; }
        button:hover { background-color: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background: white; }
        table, th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #ff32a9; color: white; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; text-decoration: none; font-weight: bold; color: #007bff; }
    </style>
</head>
<body>

    <h2>Sistem Informasi Kantin Sekolah</h2>
    <div class="nav">
        <a href="index.php">Data Pelanggan</a> | 
        <a href="pemesanan.php">Transaksi Pemesanan</a> | 
        <a href="piket.php">Absensi Piket Kasir</a>
    </div>

    <div class="container">
        <!-- Form Tambah Pelanggan -->
        <div class="card" style="width: 35%;">
            <h3>Tambah Pelanggan</h3>
            <form action="" method="POST">
                <label>NIS</label>
                <input type="text" name="nis" required maxlength="10">

                <label>Nama Siswa</label>
                <input type="text" name="nama_siswa" required maxlength="50">

                <label>Kelas</label>
                <input type="text" name="kelas" required maxlength="15">

                <label>No. WhatsApp</label>
                <input type="text" name="no_whatsapp" maxlength="15">

                <button type="submit" name="simpan_pelanggan">Simpan Pelanggan</button>
            </form>
        </div>

        <!-- Tabel Data Pelanggan -->
        <div class="card" style="width: 65%;">
            <h3>Daftar Pelanggan Kantin</h3>
            <table>
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>No. WA</th>
                    <th>Tgl Daftar</th>
                </tr>
                <?php
                $data = mysqli_query($koneksi, "SELECT * FROM tblpelanggankantin ORDER BY tgl_daftar DESC");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?= $d['NIS']; ?></td>
                    <td><?= $d['nama_siswa']; ?></td>
                    <td><?= $d['kelas']; ?></td>
                    <td><?= $d['no_whatsapp']; ?></td>
                    <td><?= $d['tgl_daftar']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>
</html>