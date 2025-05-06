<?php
include "koneksi.php";

if (isset($_GET['npm'])) {
    $npm = mysqli_real_escape_string($koneksi, $_GET['npm']);
    
    // Query delete data
    $query = "DELETE FROM tbl_mahasiswa WHERE npm = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $npm);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data berhasil dihapus');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . addslashes(mysqli_error($koneksi)) . "');
                window.location.href='index.php';
              </script>";
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: index.php");
}

mysqli_close($koneksi);
?>