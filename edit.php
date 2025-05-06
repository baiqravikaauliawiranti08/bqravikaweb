<?php
include "koneksi.php";

// Ambil data berdasarkan NPM
if (isset($_GET['npm'])) {
    $npm = mysqli_real_escape_string($koneksi, $_GET['npm']);
    $query = "SELECT * FROM tbl_mahasiswa WHERE npm = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $npm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if (!$data) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    
    $query = "UPDATE tbl_mahasiswa SET nama = ?, prodi = ?, email = ?, alamat = ? WHERE npm = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $prodi, $email, $alamat, $npm);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate data: " . addslashes(mysqli_error($koneksi)) . "');</script>";
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <style>
        /* Gunakan style yang sama dengan tambah.php */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding: 0;
        }
        h3 {
            text-align: center;
            color: #d63384;
            margin-top: 30px;
            font-size: 24px;
        }
        p {
            text-align: center;
            color: #8b2252;
        }
        form {
            width: 400px;
            margin: 30px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(214, 51, 132, 0.2);
            border: 1px solid #ffcce6;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ffb6d9;
            border-radius: 8px;
            font-size: 14px;
            background-color: #fff9fb;
        }
        input[type="submit"] {
            background-color: #d63384;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #b02a6f;
            transform: translateY(-2px);
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d63384;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-top: 20px;
            font-weight: 500;
        }
        .back-link:hover {
            background-color: #b02a6f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(214, 51, 132, 0.2);
        }
        .form-footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h3>Edit Data Mahasiswa</h3>

    <form method="POST" action="">
        <table>
            <tr>
                <td><label>NPM:</label></td>
                <td><input type="text" value="<?= htmlspecialchars($data['npm']) ?>" readonly style="background-color: #eee;"></td>
            </tr>
            <tr>
                <td><label for="nama">Nama:</label></td>
                <td><input type="text" name="nama" id="nama" value="<?= htmlspecialchars($data['nama']) ?>" required></td>
            </tr>
            <tr>
                <td><label for="prodi">Program Studi:</label></td>
                <td>
                    <select name="prodi" id="prodi" required>
                        <option value="">--Pilih Prodi--</option>
                        <option value="Pendidikan Informatika" <?= $data['prodi'] == 'Pendidikan Informatika' ? 'selected' : '' ?>>Pendidikan Informatika</option>
                        <option value="Teknologi Informasi" <?= $data['prodi'] == 'Teknologi Informasi' ? 'selected' : '' ?>>Teknologi Informasi</option>
                        <option value="Sistem Informasi" <?= $data['prodi'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                        <option value="Teknik Komputer" <?= $data['prodi'] == 'Teknik Komputer' ? 'selected' : '' ?>>Teknik Komputer</option>
                        <option value="Teknik Informatika" <?= $data['prodi'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" value="<?= htmlspecialchars($data['email']) ?>"></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat:</label></td>
                <td><textarea name="alamat" id="alamat" rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Update Data"></td>
            </tr>
        </table>
    </form>

    <div class="form-footer">
        <a href="index.php" class="back-link">← Kembali ke Daftar Mahasiswa</a>
    </div>
</body>
</html>