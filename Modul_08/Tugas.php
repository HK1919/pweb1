<!-- index.php -->
<?php
session_start();
$file = 'alumni.csv';

function readData($file) {
    $data = [];
    if (file_exists($file)) {
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($row = fgetcsv($handle)) !== FALSE) {
                $data[] = $row;
            }
            fclose($handle);
        }
    }
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $handle = fopen($file, "a");
        fputcsv($handle, [$_POST['nim'], $_POST['nama'], $_POST['jurusan'], $_POST['tahun_lulus'], $_POST['pekerjaan'], $_POST['perusahaan']]);
        fclose($handle);
        $message = "Data berhasil ditambahkan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tracer Alumni FKOM</h2>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>

        <!-- Form Input -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Input Data Alumni</h4>
                <form method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="nim" class="form-control" placeholder="NIM" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan Sekarang" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="perusahaan" class="form-control" placeholder="Nama Perusahaan" required>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card">
            <div class="card-body">
                <h4>Data Alumni</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Tahun Lulus</th>
                                <th>Pekerjaan</th>
                                <th>Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = readData($file);
                            foreach ($data as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row[0]) ?></td>
                                    <td><?= htmlspecialchars($row[1]) ?></td>
                                    <td><?= htmlspecialchars($row[2]) ?></td>
                                    <td><?= htmlspecialchars($row[3]) ?></td>
                                    <td><?= htmlspecialchars($row[4]) ?></td>
                                    <td><?= htmlspecialchars($row[5]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>