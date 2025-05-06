<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #d63384;
            margin-top: 30px;
            font-size: 36px;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #d63384;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .button:hover {
            background-color: #b02a6f;
            transform: translateY(-2px);
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto 40px auto;
            box-shadow: 0 0 15px rgba(214, 51, 132, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ffcce6;
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #d63384;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #fff9fb;
        }
        tr:hover {
            background-color: #ffebf3;
        }
        .aksi a {
            margin: 0 5px;
            padding: 8px 12px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        .edit {
            background-color: #28a745;
        }
        .edit:hover {
            background-color: #218838;
        }
        .hapus {
            background-color: #dc3545;
        }
        .hapus:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>
    <div class="button-container">
        <a class="button" href="tambah.php">+ Tambah Data Mahasiswa</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa");
        $no = 1;

        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$data['npm']}</td>
                    <td>{$data['nama']}</td>
                    <td>{$data['prodi']}</td>
                    <td>{$data['email']}</td>
                    <td>{$data['alamat']}</td>
                    <td>
                        <a class='edit' href='edit.php?npm={$data['npm']}'>Edit</a>
                        <a class='hapus' href='hapus.php?npm={$data['npm']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                    </td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>