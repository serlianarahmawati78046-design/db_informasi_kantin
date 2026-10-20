<?php 
include 'koneksi.php';
?>
<html>
    <head>
        <title>Transaksi Pemesanan Kantin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
        }
        h2, h3 {
            color: #333;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ff32c2;
            color: white;
        }
        .nav {
            margin-bottom: 20px;
            display: flex;
            gap: 25px;
        }
        .nav a {
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }
        .btn-tambah {
            display: inline-block;
            background-color: #ff27d0;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .btn-tambah:hover {
            background-color: #d91bb0;
        }
    </style>
    </head>
    <body>
        <h2>Sistem Informasi Kantin Sekolah</h2>
        <div class="nav">
            <a href="index.php">Data Pelanggan</a> |
            <a href="pemesanan.php">Transaksi Pemesanan</a> |
            <a href="piket.php">Absensi Piket Kasir</a>  |
            <a href="menu.php">Menu</a>
        </div>
        <div class="card">
            <h3>Daftar Transaksi Pemesanan</h3>
            <a href="tambah_pemesanan.php" class="btn-tambah">
                + Tambah Transaksi
            </a>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Pesanan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
                <?php
                $query_tabel = "SELECT tblpemesanankantin.*, tblpelanggankantin.nama_siswa 
                        FROM tblpemesanankantin 
                        INNER JOIN tblpelanggankantin 
                        ON tblpemesanankantin.NIS = tblpelanggankantin.NIS 
                        ORDER BY tgl_transaksi DESC";
                $data = mysqli_query($koneksi, $query_tabel);
                while ($d = mysqli_fetch_array($data)) {
                    ?>
                
                <tr>
                    <td><?= $d['no_transaksi']; ?></td>
                    <td><?= $d['nama_siswa']; ?></td>
                    <td><?= $d['nama_pesanan']; ?></td>
                    <td><?= $d['jumlah_beli']; ?></td>
                    <td>Rp <?= number_format($d['total_harga'], 0, ',', '.'); ?></td>
                    <td><?=$d['tgl_transaksi']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>