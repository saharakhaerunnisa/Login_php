<?php
session_start();
include "koneksi.php";

// Tangkap input
$email = $_POST['email'];
$password = $_POST['password'];

// Ambil user dan rolenya
$query = mysqli_query($koneksi, "SELECT u.*, r.name as role FROM user u
JOIN role r ON u.role_id = r.id
WHERE u.email='$email' AND u.password='$password'");

// Cek data ditemukan
if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    // simpan ke session (opsional)
    $_SESSION['email'] = $data['email'];
    $_SESSION['role_id'] = $data['role_id'];

    // redirect berdasarkan role
    switch($data['role_id']) {
        case '1':
            header("Location: admin/index.html");
            break;
        case '2':
            header("Location: karyawan/index.html");
            break;
        case '3':
            header("Location: pelanggan/index.html");
            break;
        default:
            header("Location: index.html?pesan=gagal");
    }
    exit();
} else {
    header("Location: index.html?pesan=gagal");
    exit();
}
?>
