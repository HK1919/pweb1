<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Alumni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>FORM DATA ALUMNI</h3>
    <hr>

    <?php
    include "Latihan_09_config.php"; // Memasukkan file konfigurasi untuk koneksi database

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $tahun_lulus = $_POST['tahun_lulus'];
        $jurusan = $_POST['jurusan'];

        // Mengelola Upload Foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Memeriksa apakah file benar-benar gambar
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<div class='alert alert-danger'>File bukan gambar.</div>";
                $uploadOk = 0;
            }

            // Memeriksa ukuran file (5MB maks)
            if ($_FILES["foto"]["size"] > 5000000) {
                echo "<div class='alert alert-danger'>Ukuran file terlalu besar.</div>";
                $uploadOk = 0;
            }

            // Mengizinkan format file tertentu
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, PNG & GIF yang diizinkan.</div>";
                $uploadOk = 0;
            }

            // Cek apakah $uploadOk sudah di-set menjadi 0 oleh error
            if ($uploadOk == 0) {
                echo "<div class='alert alert-danger'>File tidak berhasil diunggah.</div>";
            } else {
                // Jika file berhasil diunggah
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Tambahkan data ke database
                    $sql = "INSERT INTO alumni (nama, tahun_lulus, jurusan, foto) VALUES ('$nama', '$tahun_lulus', '$jurusan', '$target_file')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengunggah file.</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Tidak ada file yang diunggah atau file terlalu besar.</div>";
        }

        $conn->close();
    }
    ?>

    <h2 class="mb-4">Tambah Data Alumni</h2>
    <!-- Form tambah data -->
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
        </div>

        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
