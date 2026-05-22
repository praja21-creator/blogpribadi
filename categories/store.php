<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    if(empty($name)) {
        header('Location: index.php?error=Nama kategori tidak boleh kosong');
        exit;
    }
    
    $slug = strtolower($name);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
    
    // Cek duplikat
    $check = mysqli_query($conn, "SELECT id FROM categories WHERE name = '$name'");
    if(mysqli_num_rows($check) > 0) {
        header('Location: index.php?error=Kategori sudah ada');
        exit;
    }
    
    $insert = mysqli_query($conn, "INSERT INTO categories(name, slug) VALUES('$name', '$slug')");
    
    if($insert) {
        header('Location: index.php?success=Kategori berhasil ditambahkan');
    } else {
        header('Location: index.php?error=Gagal menambahkan kategori');
    }
} else {
    header('Location: index.php');
}
