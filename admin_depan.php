
<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

// Tombol search 
if( isset($_POST["cari"]) ) {
    $data_siswa = cari($_POST["keyword"]);
} else {
    // Jika tidak ada pencarian, tampilkan semua data siswa
    $data_siswa = query("SELECT * FROM data_siswa");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>

<a href="logout.php" onclick="return confirm('Yakin ingin logout?')" style="display: inline-block; padding: 10px 20px; background-color: #dc3545; color: #fff; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Logout</a>

<h1>Data Mahasiswa</h1>

<a href="tambah.php">
    <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">TAMBAH DATA MAHASISWA</button>
</a>
<br>    

<form action="" method="post" style="margin-top: 20px; margin-bottom: 20px;">
    <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan data yang ingin dicari..." autocomplete="off" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
    <button type="submit" name="cari" style="padding: 8px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Cari</button>
</form>

<?php if(isset($_POST["cari"])): ?>
    <a href="admin_depan.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Kembali</a>
<?php endif; ?>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px; overflow-y: scroll;">
    <tr>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">NO</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">EDIT</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">NAMA</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">NIM</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">KOTA</th>
        <th style="background-color: #f2f2f2; padding: 8px; border-bottom: 1px solid #ddd;">EMAIL</th>
    </tr>

    <?php $a = 1; ?>   
    <?php foreach ($data_siswa as $row) : ?>   
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $a; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                <a href="edit.php?id=<?= $row["id"]; ?>">
                    <button style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Edit</button>
                </a>
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data?');">
                    <button style="padding: 5px 10px; background-color: #dc3545; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Hapus</button>
                </a>
            </td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["name"]; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["nim"]; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["city"]; ?></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?= $row["email"]; ?></td>
        </tr>
        <?php $a++; ?>
    <?php endforeach; ?>
</table>

</body>
</html>