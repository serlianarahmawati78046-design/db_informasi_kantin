<?php
include 'koneksi.php';
?>
<html>
    <head>
        <title>Menu Kantin</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
        }

        h2, h3 {
            color: #333;
        }

        .nav {
            margin-bottom: 20px;
        }

        .nav a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
            color: #007bff;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ff32c2;
            color: white;
        }
        </style>
    </head>
    <body>

<h2>Sistem Informasi Kantin Sekolah</h2>

<!-- NAVIGATION -->
<div class="nav">
    <a href="index.php">Data Pelanggan</a> |
    <a href="menu.php">Menu</a> |
    <a href="pemesanan.php">Transaksi Pemesanan</a> |
    <a href="piket.php">Absensi Piket Kasir</a>
</div>

<div class="card">

    <h3>Daftar Menu Kantin</h3>

    <a href="tambah_menu.php" class="btn-tambah">
        + Tambah Menu
    </a>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
        </tr>

        <?php

        $query = mysqli_query($koneksi, "SELECT * FROM tblmenukantin");

        $no = 1;

        while ($data = mysqli_fetch_array($query)) {

        ?>

        <tr>
            <td><?= $no++; ?></td>

            <td>
                <?= $data['nama_menu']; ?>
            </td>

            <td>
                <?= $data['kategori']; ?>
            </td>

            <td>
                <?= $data['stok']; ?>
            </td>

            <td>
                Rp <?= number_format($data['harga'], 0, ',', '.'); ?>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>
</html>