
<?php
include 'koneksi.php';

// Mengambil ID transaksi dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("ID transaksi tidak valid!");
}

// Mengambil data transaksi dan pelanggan
$query_transaksi = mysqli_prepare(
    $koneksi,
    "SELECT transaksi.*, pelanggan.nama
     FROM transaksi
     JOIN pelanggan
     ON transaksi.pelanggan_id = pelanggan.id
     WHERE transaksi.id = ?"
);

mysqli_stmt_bind_param($query_transaksi, "i", $id);
mysqli_stmt_execute($query_transaksi);

$hasil_transaksi = mysqli_stmt_get_result($query_transaksi);
$transaksi = mysqli_fetch_assoc($hasil_transaksi);

if (!$transaksi) {
    die("Transaksi tidak ditemukan!");
}


// FUNGSI MENGHITUNG ULANG TOTAL TRANSAKSI
function hitungTotal($koneksi, $id) {

    $update = mysqli_prepare(
        $koneksi,
        "UPDATE transaksi
         SET total = (
             SELECT COALESCE(SUM(harga * qty), 0)
             FROM transaksi_detail
             WHERE transaksi_id = ?
         )
         WHERE id = ?"
    );

    mysqli_stmt_bind_param($update, "ii", $id, $id);
    mysqli_stmt_execute($update);
}


// PROSES MENAMBAHKAN DETAIL BARANG
if (isset($_POST['tambah'])) {

    $barang_id = (int) $_POST['barang_id'];
    $qty = (int) $_POST['qty'];

    if ($barang_id <= 0 || $qty <= 0) {
        die("Barang dan jumlah harus diisi dengan benar!");
    }

    // Memulai transaksi database
    mysqli_begin_transaction($koneksi);

    try {

        // Mengambil harga barang
        $barang = mysqli_prepare(
            $koneksi,
            "SELECT harga FROM barang WHERE id = ?"
        );

        mysqli_stmt_bind_param($barang, "i", $barang_id);
        mysqli_stmt_execute($barang);

        $hasil_barang = mysqli_stmt_get_result($barang);
        $data_barang = mysqli_fetch_assoc($hasil_barang);

        if (!$data_barang) {
            throw new Exception("Barang tidak ditemukan!");
        }

        $harga = (int) $data_barang['harga'];

        // Mengecek apakah barang sudah ada
        $cek = mysqli_prepare(
            $koneksi,
            "SELECT barang_id
             FROM transaksi_detail
             WHERE transaksi_id = ?
             AND barang_id = ?"
        );

        mysqli_stmt_bind_param($cek, "ii", $id, $barang_id);
        mysqli_stmt_execute($cek);

        $hasil_cek = mysqli_stmt_get_result($cek);

        if (mysqli_num_rows($hasil_cek) > 0) {
            throw new Exception(
                "Barang sudah dimasukkan dalam transaksi ini!"
            );
        }

        // Menyimpan detail transaksi
        $simpan = mysqli_prepare(
            $koneksi,
            "INSERT INTO transaksi_detail
             (transaksi_id, barang_id, harga, qty)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $simpan,
            "iiii",
            $id,
            $barang_id,
            $harga,
            $qty
        );

        if (!mysqli_stmt_execute($simpan)) {
            throw new Exception("Gagal menyimpan detail transaksi!");
        }

        // Menghitung ulang total transaksi
        hitungTotal($koneksi, $id);

        // Menyimpan semua perubahan
        mysqli_commit($koneksi);

        echo "<script>
            alert('Detail barang berhasil ditambahkan dan total transaksi diperbarui!');
            window.location='detail_transaksi.php?id=$id';
        </script>";
        exit;

    } catch (Exception $e) {

        // Membatalkan perubahan jika terjadi kesalahan
        mysqli_rollback($koneksi);

        $pesan = json_encode($e->getMessage());

        echo "<script>
            alert($pesan);
            window.location='detail_transaksi.php?id=$id';
        </script>";
        exit;
    }
}


// PROSES MENGHAPUS DETAIL BARANG
if (isset($_POST['hapus'])) {

    $barang_id = (int) $_POST['barang_id'];

    mysqli_begin_transaction($koneksi);

    try {

        $hapus = mysqli_prepare(
            $koneksi,
            "DELETE FROM transaksi_detail
             WHERE transaksi_id = ?
             AND barang_id = ?"
        );

        mysqli_stmt_bind_param(
            $hapus,
            "ii",
            $id,
            $barang_id
        );

        if (!mysqli_stmt_execute($hapus)) {
            throw new Exception("Gagal menghapus barang!");
        }

        // Menghitung ulang total setelah penghapusan
        hitungTotal($koneksi, $id);

        mysqli_commit($koneksi);

        echo "<script>
            alert('Detail barang berhasil dihapus!');
            window.location='detail_transaksi.php?id=$id';
        </script>";
        exit;

    } catch (Exception $e) {

        mysqli_rollback($koneksi);

        $pesan = json_encode($e->getMessage());

        echo "<script>
            alert($pesan);
            window.location='detail_transaksi.php?id=$id';
        </script>";
        exit;
    }
}


// DROPDOWN BARANG
// Barang yang sudah dimasukkan tidak ditampilkan
$query_barang = mysqli_prepare(
    $koneksi,
    "SELECT * FROM barang b
     WHERE NOT EXISTS (
         SELECT 1
         FROM transaksi_detail td
         WHERE td.transaksi_id = ?
         AND td.barang_id = b.id
     )
     ORDER BY b.nama_barang ASC"
);

mysqli_stmt_bind_param($query_barang, "i", $id);
mysqli_stmt_execute($query_barang);

$barang = mysqli_stmt_get_result($query_barang);


// MENGAMBIL DATA DETAIL TRANSAKSI
$query_detail = mysqli_prepare(
    $koneksi,
    "SELECT td.*, b.kode_barang, b.nama_barang
     FROM transaksi_detail td
     JOIN barang b
     ON td.barang_id = b.id
     WHERE td.transaksi_id = ?"
);

mysqli_stmt_bind_param($query_detail, "i", $id);
mysqli_stmt_execute($query_detail);

$detail = mysqli_stmt_get_result($query_detail);


// MENGAMBIL TOTAL TRANSAKSI TERBARU
$query_total = mysqli_prepare(
    $koneksi,
    "SELECT total FROM transaksi WHERE id = ?"
);

mysqli_stmt_bind_param($query_total, "i", $id);
mysqli_stmt_execute($query_total);

$hasil_total = mysqli_stmt_get_result($query_total);
$data_total = mysqli_fetch_assoc($hasil_total);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Detail Transaksi</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f6f9;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            max-width: 1100px;
            margin: auto;
        }

        h2, h3 {
            color: #333;
        }

        input, select, button {
            padding: 10px;
            margin: 5px 0 12px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background: #087cf0;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            opacity: 0.85;
        }

        .hapus {
            background: #dc3545;
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

        .total {
            background: #e8f4ff;
            padding: 15px;
            border-radius: 5px;
            text-align: right;
            margin-top: 20px;
        }

        .kembali {
            display: inline-block;
            margin-bottom: 20px;
            color: #087cf0;
            text-decoration: none;
        }

        .info {
            background: #f4f6f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <a href="transaksi.php" class="kembali">
        ← Kembali ke Transaksi
    </a>

    <h2>Detail Transaksi #<?= $id ?></h2>

    <div class="info">

        <p>
            <b>Tanggal Transaksi:</b>
            <?= htmlspecialchars($transaksi['waktu_transaksi']) ?>
        </p>

        <p>
            <b>Nama Pelanggan:</b>
            <?= htmlspecialchars($transaksi['nama']) ?>
        </p>

        <p>
            <b>Keterangan:</b>
            <?= htmlspecialchars($transaksi['keterangan'] ?? '') ?>
        </p>

    </div>

    <hr>

    <h3>Tambah Barang</h3>

    <form method="POST">

        <label>Pilih Barang</label>

        <select name="barang_id" required>

            <option value="">-- Pilih Barang --</option>

            <?php while ($b = mysqli_fetch_assoc($barang)) { ?>

                <option value="<?= $b['id'] ?>">

                    <?= htmlspecialchars($b['kode_barang']) ?>
                    -
                    <?= htmlspecialchars($b['nama_barang']) ?>

                    (Rp <?= number_format(
                        $b['harga'], 0, ',', '.'
                    ) ?>)

                </option>

            <?php } ?>

        </select>

        <label>Jumlah Barang</label>

        <input
            type="number"
            name="qty"
            min="1"
            placeholder="Masukkan jumlah barang"
            required
        >

        <button type="submit" name="tambah">
            + Tambahkan Barang
        </button>

    </form>

    <hr>

    <h3>Daftar Detail Barang</h3>

    <table>

        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        if (mysqli_num_rows($detail) > 0) {

            while ($d = mysqli_fetch_assoc($detail)) {
        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td>
                <?= htmlspecialchars($d['kode_barang']) ?>
            </td>

            <td>
                <?= htmlspecialchars($d['nama_barang']) ?>
            </td>

            <td>
                Rp <?= number_format(
                    $d['harga'], 0, ',', '.'
                ) ?>
            </td>

            <td><?= $d['qty'] ?></td>

            <td>
                Rp <?= number_format(
                    $d['harga'] * $d['qty'],
                    0, ',', '.'
                ) ?>
            </td>

            <td>

                <form
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                >

                    <input
                        type="hidden"
                        name="barang_id"
                        value="<?= $d['barang_id'] ?>"
                    >

                    <button
                        type="submit"
                        name="hapus"
                        class="hapus"
                    >
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

        <?php
            }

        } else {
        ?>

        <tr>
            <td colspan="7" style="text-align:center;">
                Belum ada barang dalam transaksi ini.
            </td>
        </tr>

        <?php } ?>

    </table>

    <div class="total">

        <h3>
            Total Transaksi:

            Rp <?= number_format(
                $data_total['total'],
                0,
                ',',
                '.'
            ) ?>
        </h3>

    </div>

</div>

</body>
</html>
