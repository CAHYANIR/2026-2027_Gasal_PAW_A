
<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = mysqli_prepare(
        $koneksi,
        "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)"
    );

    mysqli_stmt_bind_param($query, "sss", $nama, $telp, $alamat);

    if (mysqli_stmt_execute($query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            width: 85%;
            background: #fff;
        }

        h2 {
            color: #43829b;
            font-size: 22px;
            font-weight: normal;
        }

        .form-container {
            border: 1px solid #ddd;
            padding: 25px;
            width: 60%;
            background: #fff;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 18px;
            font-family: Arial, sans-serif;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #43829b;
        }

        textarea {
            height: 90px;
            resize: vertical;
        }

        .simpan {
            background: #78b34b;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .kembali {
            background: #c82333;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 5px;
        }

        .simpan:hover {
            background: #659b3d;
        }

        .kembali:hover {
            background: #a71d2a;
        }
    </style>
</head>

<body>

<h2>Tambah Data Supplier</h2>

<div class="form-container">

    <form method="POST">

        <label>Nama Supplier</label>
        <input type="text" name="nama"
            placeholder="Masukkan nama supplier"
            required>

        <label>Telepon</label>
        <input type="text" name="telp"
            maxlength="12"
            placeholder="Masukkan nomor telepon"
            required>

        <label>Alamat</label>
        <textarea name="alamat"
            placeholder="Masukkan alamat supplier"
            required></textarea>

        <button type="submit" name="simpan" class="simpan">
            Simpan Data
        </button>

        <a href="index.php" class="kembali">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
