<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    if(empty($name)) {
        header('Location: index.php?error=Nama kategori tidak boleh kosong');
        exit;
    }
    
    // Cek apakah kategori ada
    $check = mysqli_query($conn, "SELECT id FROM categories WHERE id = $id");
    if(mysqli_num_rows($check) == 0) {
        header('Location: index.php?error=Kategori tidak ditemukan');
        exit;
    }
    
    $slug = strtolower($name);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
    
    $update = mysqli_query($conn, "UPDATE categories SET name = '$name', slug = '$slug' WHERE id = $id");
    
    if($update) {
        header('Location: index.php?success=Kategori berhasil diupdate');
    } else {
        header('Location: index.php?error=Gagal mengupdate kategori');
    }
} else {
    header('Location: index.php');
}
