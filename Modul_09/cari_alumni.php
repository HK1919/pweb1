<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .form-group input {
            border-radius: 20px;
            padding: 12px;
        }

        .btn-primary {
            border-radius: 20px;
            padding: 10px 20px;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table img {
            border-radius: 50%;
        }

        .btn-secondary {
            border-radius: 20px;
            padding: 10px 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center mb-4">Search Name</h3>
        <form method="GET" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="search_name" placeholder="Enter a name" class="form-control">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <?php
        include 'Latihan_09_config.php';
        $search_name = $_GET['search_name'] ?? '';
        if ($search_name !== '') {
            $stmt = $conn->prepare("SELECT * FROM alumni WHERE nama LIKE ?");
            $like_name = "%$search_name%";
            $stmt->bind_param("s", $like_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>ID</th><th>Nama</th><th>Tahun Lulus</th><th>Jurusan</th><th>Foto</th></tr></thead><tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['id']}</td><td>{$row['nama']}</td><td>{$row['tahun_lulus']}</td><td>{$row['jurusan']}</td><td><img src='{$row['foto']}' width='50'></td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-danger text-center'>No results found for <strong>$search_name</strong>.</p>";
            }
            $stmt->close();
        }
        $conn->close();
        ?>

        <a href="Latihan_09_index.php" class="btn btn-secondary w-100">Back to Homepage</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
