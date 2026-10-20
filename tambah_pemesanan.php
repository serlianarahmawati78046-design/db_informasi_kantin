<?php
include 'koneksi.php';
?>
<html>
    <head>
        <title>Tambah Transaksi</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f4f6f9;
        }

        .card {
            background: white;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        input, select, button {
            display: block;
            width: 100%;
            margin-bottom: 12px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #ff27d0;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .kembali {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #007bff;
        }
        </style>
    </head>
    <body>
        <div class="card">

    <a href="pemesanan.php" class="kembali">
        ← Kembali
    </a>

    <h3>Tambah Transaksi</h3>

    <form action="proses_pemesanan.php" method="POST">

        <label>No. Transaksi</label>
        <input type="text"
               name="no_transaksi"
               value="TRX-<?= date('YmdHis'); ?>"
               readonly>

        <label>Pilih Pelanggan (NIS - Nama)</label>

        <select name="nis" required>
            <option value="">-- Pilih Pelanggan --</option>

            <?php
            $pelanggan = mysqli_query(
                $koneksi,
                "SELECT * FROM tblpelanggankantin"
            );

            while ($p = mysqli_fetch_array($pelanggan)) {
            ?>

                <option value="<?= $p['NIS']; ?>">
                    <?= $p['NIS']; ?> - <?= $p['nama_siswa']; ?>
                </option>

            <?php } ?>

        </select>

        <label>Nama Pesanan / Makanan</label>

    <select name="nama_pesanan" required>
    <option value="">-- Pilih Menu --</option>

    <?php
    $menu = mysqli_query($koneksi, "SELECT * FROM tblmenukantin WHERE stok > 0");

    while ($m = mysqli_fetch_assoc($menu)) {
    ?>

        <option value="<?= $m['nama_menu']; ?>">
            <?= $m['nama_menu']; ?> -
            Rp <?= number_format($m['harga'], 0, ',', '.'); ?>
            (Stok: <?= $m['stok']; ?>)
        </option>

    <?php } ?>

    </select>
    <label>Jumlah Beli</label>
    <input type="number" name="jumlah_beli" min="1" required>

    <label>Total Harga (Rp)</label>
    <input type="number" name="total_harga" required>

    <button type="submit" name="simpan_transaksi">
        Simpan Transaksi
    </button>
    </form>

    </div>

    </body>
</html>