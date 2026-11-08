
<?php
include 'koneksi.php';

// Menambahkan transaksi baru
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $pelanggan = $_POST['pelanggan'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_prepare(
        $koneksi,
        "INSERT INTO transaksi
        (waktu_transaksi, keterangan, total, pelanggan_id)
        VALUES (?, ?, 0, ?)"
    );

    mysqli_stmt_bind_param(
        $query, "sss",
        $tanggal, $keterangan, $pelanggan
    );

    mysqli_stmt_execute($query);

    header("Location: transaksi.php");
    exit;
}

// Mengambil data pelanggan
$pelanggan = mysqli_query(
    $koneksi,
    "SELECT * FROM pelanggan"
);

// Mengambil data transaksi
$data = mysqli_query(
    $koneksi,
    "SELECT transaksi.*, pelanggan.nama
     FROM transaksi
     JOIN pelanggan
     ON transaksi.pelanggan_id = pelanggan.id
     ORDER BY transaksi.id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
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

        input, select, textarea, button {
            padding: 9px;
            margin: 5px 0 12px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background: #087cf0;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #087cf0;
            color: white;
        }

        a {
            color: #087cf0;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Tambah Transaksi</h2>

    <form method="POST">

        <label>Tanggal Transaksi</label>
        <input type="date" name="tanggal" required>

        <label>Pelanggan</label>
        <select name="pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>

            <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= htmlspecialchars($p['id']) ?>">
                    <?= htmlspecialchars($p['nama']) ?>
                </option>
            <?php } ?>
        </select>

        <label>Keterangan</label>
        <textarea name="keterangan"></textarea>

        <button type="submit" name="simpan">
            Simpan Transaksi
        </button>

    </form>

    <hr>

    <h2>Data Master Transaksi</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>

        <?php while ($t = mysqli_fetch_assoc($data)) { ?>

        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= $t['waktu_transaksi'] ?></td>
            <td><?= htmlspecialchars($t['nama']) ?></td>
            <td><?= htmlspecialchars($t['keterangan']) ?></td>
            <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
            <td>
                <a href="detail_transaksi.php?id=<?= $t['id'] ?>">
                    Lihat Detail
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
