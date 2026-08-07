<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../config/database.php';

$id = intval($_GET['id']);

// Cek apakah kategori ada
$check = mysqli_query($conn, "SELECT id FROM categories WHERE id = $id");
if(mysqli_num_rows($check) == 0) {
    header('Location: index.php?error=Kategori tidak ditemukan');
    exit;
}

// Hapus kategori
$delete = mysqli_query($conn, "DELETE FROM categories WHERE id = $id");

if($delete) {
    header('Location: index.php?success=Kategori berhasil dihapus');
} else {
    header('Location: index.php?error=Gagal menghapus kategori');
}
