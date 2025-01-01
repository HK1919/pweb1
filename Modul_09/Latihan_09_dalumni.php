<?php
// Menyertakan file konfigurasi database
include 'Latihan_09_config.php';

// Memeriksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    // Mengambil nilai 'id' dari URL dan melakukan sanitasi
    $id = intval($_GET['id']);

    // Membuat query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM alumni WHERE id = $id";

    // Mengeksekusi query dan memeriksa apakah berhasil
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
        // Redirect ke halaman index dengan parameter 'menu=alumni'
        header("Location: Latihan_09_index.php?menu=alumni");
        exit; // Tambahkan exit untuk memastikan header dieksekusi
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Menutup koneksi database
    $conn->close();
} else {
    echo "ID tidak ditemukan.";
}
?>
