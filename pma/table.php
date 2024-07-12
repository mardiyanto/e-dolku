<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAdmin - Table</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container mt-5">
    <?php
    include '../koneksi.php';

    $table = $_GET['table'];

    echo '<h2 class="mb-4">Data dari tabel: ' . $table . '</h2>';
echo '<a href="index.php" class="btn btn-primary mb-3">kembali</a>';

    // Query untuk mendapatkan struktur tabel
    $sql = "DESCRIBE $table";
    $structureResult = $koneksi->query($sql);

    if ($structureResult->num_rows > 0) {
        echo '<h4>Struktur Tabel</h4>';
        echo '<table class="table table-bordered mb-4">';
        echo '<thead><tr><th>Kolom</th><th>Tipe Data</th></tr></thead>';
        echo '<tbody>';
        
        while($row = $structureResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Field'] . '</td>';
            echo '<td>' . $row['Type'] . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Tidak ada informasi struktur tabel yang ditemukan.</div>';
    }

    // Query untuk mendapatkan data dari tabel yang dipilih
    $sql = "SELECT * FROM $table";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        echo '<h4>Data Tabel</h4>';
        echo '<table class="table table-bordered">';
        echo '<thead><tr>';
        // Fetch fields names
        $fields = $result->fetch_fields();
        foreach($fields as $field) {
            echo '<th>' . $field->name . '</th>';
        }

        echo '</tr></thead>';
        echo '<tbody>';
        
        // Fetch rows
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            foreach($row as $data) {
                echo '<td>' . $data . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Tidak ada data dalam tabel.</div>';
    }

    $conn->close();
    ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
