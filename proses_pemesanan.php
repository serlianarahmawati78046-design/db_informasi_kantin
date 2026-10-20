<?php

include 'koneksi.php';

if (isset($_POST['simpan_transaksi'])) {

    // 1. Buat nomor transaksi unik otomatis
    $no_transaksi = "TRX-" . date('Ymd') . "-" . mt_rand(1000, 9999);

    $nis          = $_POST['nis'];
    $nama_pesanan = $_POST['nama_pesanan'];
    $jumlah_beli  = $_POST['jumlah_beli'];
    $total_harga  = $_POST['total_harga'];

    // 2. Simpan data transaksi ke tabel pemesanan
    $query_transaksi = "INSERT INTO tblpemesanankantin
              (no_transaksi, NIS, nama_pesanan, jumlah_beli, total_harga)
              VALUES
              ('$no_transaksi',
               '$nis',
               '$nama_pesanan',
               '$jumlah_beli',
               '$total_harga')";

    if (mysqli_query($koneksi, $query_transaksi)) {

        // 3. KURANGI STOK DI TABEL 'tblmenukantin' SECARA OTOMATIS
        $query_update_stok = "UPDATE tblmenukantin 
                              SET stok = stok - $jumlah_beli 
                              WHERE nama_menu = '$nama_pesanan'";
        
        mysqli_query($koneksi, $query_update_stok);

        // 4. Jika sukses, tampilkan alert dan kembali ke halaman pemesanan
        echo "<script>
                alert('Transaksi Berhasil dan Stok Berkurang!');
                window.location='pemesanan.php';
              </script>";

    } else {

        // Jika ada error pada query
        echo "Error: " . mysqli_error($koneksi);

    }
}
?>