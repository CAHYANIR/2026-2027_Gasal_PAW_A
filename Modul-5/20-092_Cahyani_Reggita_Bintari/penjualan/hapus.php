
<?php
include 'koneksi.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = mysqli_prepare(
        $koneksi,
        "DELETE FROM supplier WHERE id = ?"
    );

    mysqli_stmt_bind_param($query, "i", $id);

    if (mysqli_stmt_execute($query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menghapus data!";
    }
}
?>
