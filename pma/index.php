<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAdmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Tabel</h2>
    <?php
    include '../koneksi.php';

    // Query untuk mendapatkan tabel
    $sql = "SHOW TABLES";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        echo '<ul class="list-group">';
        while($row = $result->fetch_array()) {
            echo '<li class="list-group-item"><a href="table.php?table=' . $row[0] . '">' . $row[0] . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Tidak ada tabel yang ditemukan.</div>';
    }

    $conn->close();
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
