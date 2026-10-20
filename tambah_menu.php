<?php
include 'koneksi.php';

if (isset($_POST['simpan_menu'])) {

    $nama_menu = $_POST['nama_menu'];
    $harga     = $_POST['harga'];
    $stok      = $_POST['stok'];
    $kategori  = $_POST['kategori'];

    $query = "INSERT INTO tblmenukantin
              (nama_menu, harga, stok, kategori)
              VALUES
              ('$nama_menu', '$harga', '$stok', '$kategori')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Menu berhasil ditambahkan!');
                window.location='menu.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<html>
<head>
    <title>Tambah Menu Kantin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
        }

        .card {
            width: 400px;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, button {
        display: block;
        width: 100%;
        margin-bottom: 12px;
        padding: 10px;
        box-sizing: border-box;
        font-size: 14px;
        }

        select {
        height: 40px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ff27d0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d91bb0;
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

    <a href="menu.php" class="kembali">← Kembali ke Menu</a>

    <h2>Tambah Menu Kantin</h2>

    <form method="POST">

        <label>Nama Menu</label>
        <input type="text" name="nama_menu"
               placeholder="Masukkan nama menu"
               required>

        <label>Harga</label>
        <input type="number" name="harga"
               placeholder="Masukkan harga"
               required>

        <label>Kategori</label>
        <select name="kategori">
            <option value="">Semua Kategori</option>
            <option value="Makanan">Makanan</option>
            <option value="Minuman">Minuman</option>
            <option value="Snack">Snack</option>
            <option value="Dessert">Dessert</option>
        </select>

        <label>Stok</label>
        <input type="number" name="stok"
               placeholder="Masukkan stok"
               required>

        <button type="submit" name="simpan_menu">
            Simpan Menu
        </button>

    </form>

</div>

</body>
</html>