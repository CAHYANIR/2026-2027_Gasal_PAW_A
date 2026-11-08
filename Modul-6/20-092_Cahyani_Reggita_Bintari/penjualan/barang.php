
<?php
include 'koneksi.php';

// Proses hapus barang
if (isset($_POST['hapus'])) {

    $id = (int) $_POST['id'];

    // Mengecek apakah barang digunakan di transaksi_detail
    $cek = mysqli_prepare(
        $koneksi,
        "SELECT barang_id FROM transaksi_detail
         WHERE barang_id = ?"
    );

    mysqli_stmt_bind_param($cek, "i", $id);
    mysqli_stmt_execute($cek);

    $hasil = mysqli_stmt_get_result($cek);

    if (mysqli_num_rows($hasil) > 0) {

        // Barang masih digunakan
        echo "<script>
            alert('Barang tidak dapat dihapus karena masih digunakan pada transaksi!');
            window.location='barang.php';
        </script>";

    } else {

        // Barang belum digunakan, boleh dihapus
        $hapus = mysqli_prepare(
            $koneksi,
            "DELETE FROM barang WHERE id = ?"
        );

        mysqli_stmt_bind_param($hapus, "i", $id);

        if (mysqli_stmt_execute($hapus)) {

            echo "<script>
                alert('Data barang berhasil dihapus!');
                window.location='barang.php';
            </script>";

        } else {

            echo "<script>
                alert('Data barang gagal dihapus!');
                window.location='barang.php';
            </script>";
        }
    }

    exit;
}

// Mengambil seluruh data barang
$data = mysqli_query(
    $koneksi,
    "SELECT barang.*, supplier.nama AS nama_supplier
     FROM barang
     JOIN supplier ON barang.supplier_id = supplier.id
     ORDER BY barang.id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>

    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f4f6f9;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #087cf0;
            color: white;
        }

        button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Data Barang</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        while ($b = mysqli_fetch_assoc($data)) {
        ?>

        <tr>
            <td><?= $no++ ?></td>

            <td><?= htmlspecialchars($b['kode_barang']) ?></td>

            <td><?= htmlspecialchars($b['nama_barang']) ?></td>

            <td>
                Rp <?= number_format($b['harga'], 0, ',', '.') ?>
            </td>

            <td><?= $b['stok'] ?></td>

            <td><?= htmlspecialchars($b['nama_supplier']) ?></td>

            <td>
                <form method="POST"
                      onsubmit="return confirm('Apakah yakin ingin menghapus barang ini?')">

                    <input type="hidden"
                           name="id"
                           value="<?= $b['id'] ?>">

                    <button type="submit" name="hapus">
                        Hapus
                    </button>

                </form>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
