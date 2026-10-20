<?php
include 'koneksi.php';

// Proses Simpan Piket
if (isset($_POST['simpan_piket'])) {
    $id_piket     = $_POST['id_piket'];
    $nis          = $_POST['nis'];
    $shift        = $_POST['shift'];
    $status_hadir = $_POST['status_hadir'];

    $query = "INSERT INTO tblpiketkasir (id_piket, NIS, shift, status_hadir) 
              VALUES ('$id_piket', '$nis', '$shift', '$status_hadir')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Absensi Piket Berhasil!'); window.location='piket.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Piket Kasir</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f6f9; }
        h2, h3 { color: #333; }
        .container { display: flex; gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        form input, form select, form button { display: block; width: 100%; margin-bottom: 12px; padding: 8px; box-sizing: border-box; }
        button { background-color: #f823c3; color: white; border: none; cursor: pointer; border-radius: 4px; }
        button:hover { background-color: #138496; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background: white; }
        table, th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #ff2cb9; color: white; }
        .nav { margin-bottom: 20px;
               display: flex;
               gap: 25px; }
        .nav a { margin-right: 15px; text-decoration: none; font-weight: bold; color: #007bff; }
    </style>
</head>
<body>

    <h2>Sistem Informasi Kantin Sekolah</h2>
    <div class="nav">
        <a href="index.php">Data Pelanggan</a> | 
        <a href="pemesanan.php">Transaksi Pemesanan</a> | 
        <a href="piket.php">Absensi Piket Kasir</a> |
        <a href="menu.php">Menu</a>
    </div>

    <div class="container">
        <div class="card" style="width: 35%;">
            <h3>Absensi Piket Kasir</h3>
            <form action="" method="POST">
                <label>ID Piket</label>
                <input type="text" name="id_piket" value="PKT-<?= rand(100,999); ?>" readonly>

                <label>Pilih Petugas (NIS - Nama)</label>
                <select name="nis" required>
                    <option value="">-- Pilih Petugas --</option>
                    <?php
                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM tblpelanggankantin");
                    while ($p = mysqli_fetch_array($pelanggan)) {
                        echo "<option value='".$p['NIS']."'>".$p['NIS']." - ".$p['nama_siswa']."</option>";
                    }
                    ?>
                </select>

                <label>Shift Piket</label>
                <select name="shift" required>
                    <option value="Istirahat 1">Istirahat 1</option>
                    <option value="Istirahat 2">Istirahat 2</option>
                </select>

                <label>Status Kehadiran</label>
                <select name="status_hadir" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpha">Alpha</option>
                </select>

                <button type="submit" name="simpan_piket">Simpan Piket</button>
            </form>
        </div>

        <div class="card" style="width: 65%;">
            <h3>Daftar Kehadiran Piket Kasir</h3>
            <table>
                <tr>
                    <th>ID Piket</th>
                    <th>Nama Petugas</th>
                    <th>Shift</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
                <?php
                $query_tabel = "SELECT tblpiketkasir.*, tblpelanggankantin.nama_siswa 
                                FROM tblpiketkasir 
                                INNER JOIN tblpelanggankantin 
                                ON tblpiketkasir.NIS = tblpelanggankantin.NIS 
                                ORDER BY tgl_piket DESC";
                $data = mysqli_query($koneksi, $query_tabel);
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?= $d['id_piket']; ?></td>
                    <td><?= $d['nama_siswa']; ?></td>
                    <td><?= $d['shift']; ?></td>
                    <td><?= $d['status_hadir']; ?></td>
                    <td><?= $d['tgl_piket']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>
</html>