<?php
include "Latihan_09_config.php"; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tambah data
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    $sql = "INSERT INTO buku_tamu (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Data berhasil ditambahkan"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
    exit;
} else {
    // Baca data
    $sql = "SELECT * FROM buku_tamu ORDER BY kode DESC";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
    exit;
}
?>
