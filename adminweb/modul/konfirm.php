<?php
include "../../config/koneksi.php";

if (isset($_GET['id_k'])) {
    $id_k = $_GET['id_k'];
    $query = "DELETE FROM konfirmasi WHERE id_konfrim='$id_k'";
    mysqli_query($koneksi, $query);
    echo "<script>window.location=('../index.php?aksi=konfirmasi')</script>";
}
