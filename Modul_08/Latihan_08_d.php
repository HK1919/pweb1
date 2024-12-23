<?php
session_start();

$file = 'alumni.csv'; // Mendefinisikan file CSV

// Fungsi untuk membaca data dari file CSV
function readAlumniData($file) {
    $data = [];

    if (file_exists($file)) {
        $handle = fopen($file, 'r');
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = $row;
        }
        fclose($handle);
    }

    return $data;
}

// Fungsi untuk menulis data ke file CSV
function writeAlumniData($file, $data) {
    $handle = fopen($file, 'w');
    foreach ($data as $row) {
        fputcsv($handle, $row);
    }
    fclose($handle);
}

// Mengelola Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $nim = $_POST['nim'];
    $name = $_POST['name'];
    $major = $_POST['major'];
    $year = $_POST['year'];

    // Membaca data alumni yang sudah ada
    $data = readAlumniData($file);
    
    // Menambahkan data alumni baru
    $data[] = [$nim, $name, $major, $year];

    // Menulis data yang sudah diperbarui ke file CSV
    writeAlumniData($file, $data);

    echo "<div class='alert alert-success' role='alert'>Data berhasil ditambahkan!</div>";
}

// Mengelola Delete
if (isset($_POST['delete'])) {
    $index = $_POST['index'];

    // Membaca data alumni yang ada
    $data = readAlumniData($file);
    
    // Menghapus data alumni yang dipilih
    unset($data[$index]);

    // Menghapus index array yang hilang
    $data = array_values($data);

    // Menulis data yang sudah diperbarui ke file CSV
    writeAlumniData($file, $data);

    echo "<div class='alert alert-success' role='alert'>Data berhasil dihapus!</div>";
}
?>

<div class="container">
    <h1 class="text-center">Manajemen Data Alumni</h1>

    <!-- Formulir Create -->
    <div class="card mb-4">
        <div class="card-body">
            <h4>Tambah Data Alumni</h4>
            <form method="post" action="">
                <div class="form-group mb-2">
                    <label for="nim">NIM:</label>
                    <input type="text" class="form-control" id="nim" name="nim" required>
                </div>
                <div class="form-group mb-2">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-2">
                    <label for="major">Jurusan:</label>
                    <input type="text" class="form-control" id="major" name="major" required>
                </div>
                <div class="form-group mb-3">
                    <label for="year">Angkatan:</label>
                    <input type="number" class="form-control" id="year" name="year" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add">Tambah Data<
