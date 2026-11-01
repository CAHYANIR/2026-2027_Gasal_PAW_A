
<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>

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

        .tambah {
            background: #78b34b;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            float: right;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            clear: both;
        }

        th {
            background: #d5eaf3;
            text-align: left;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 14px;
        }

        .edit {
            background: #e87513;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .hapus {
            background: #c82333;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<h2>Data Master Supplier</h2>

<a href="tambah.php" class="tambah">Tambah Data</a>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Tindakan</th>
    </tr>

    <?php
    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {
    ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($data['nama']); ?></td>
        <td><?= htmlspecialchars($data['telp']); ?></td>
        <td><?= htmlspecialchars($data['alamat']); ?></td>

        <td>
            <a class="edit"
               href="edit.php?id=<?= $data['id']; ?>">
               Edit
            </a>

            <a class="hapus"
               href="hapus.php?id=<?= $data['id']; ?>"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
               Hapus
            </a>
        </td>
    </tr>

    <?php } ?>

</table>

</body>
</html>
