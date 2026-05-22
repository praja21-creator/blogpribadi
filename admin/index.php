<?php

session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['login'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../config/database.php';
require '../layouts/header.php';

// Statistik
$posts_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM posts"))['total'];
$categories_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM categories"))['total'];

?>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="display-5 text-gradient mb-2">
                <i class="fas fa-tachometer-alt"></i> Dashboard Admin
            </h1>
            <p class="text-muted">
                Selamat datang kembali, <strong><?= $_SESSION['user']['name']; ?></strong> 👋
            </p>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <div class="card text-white" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase opacity-75 mb-2">Total Artikel</h6>
                            <h2 class="mb-0"><?= $posts_count; ?></h2>
                        </div>
                        <i class="fas fa-newspaper fa-3x opacity-25"></i>
                    </div>
                    <a href="posts.php" class="btn btn-light btn-sm mt-3">
                        <i class="fas fa-arrow-right"></i> Kelola Artikel
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card text-white" style="background: linear-gradient(135deg, #10b981, #059669);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase opacity-75 mb-2">Total Kategori</h6>
                            <h2 class="mb-0"><?= $categories_count; ?></h2>
                        </div>
                        <i class="fas fa-folder fa-3x opacity-25"></i>
                    </div>
                    <a href="../categories/index.php" class="btn btn-light btn-sm mt-3">
                        <i class="fas fa-arrow-right"></i> Kelola Kategori
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-lightning-bolt"></i> Menu Cepat</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <a href="posts.php" class="btn btn-primary w-100 py-3">
                                <i class="fas fa-list fa-lg"></i><br>
                                <small>Daftar Artikel</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <a href="../categories/index.php" class="btn btn-success w-100 py-3">
                                <i class="fas fa-list fa-lg"></i><br>
                                <small>Daftar Kategori</small>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <a href="../POST/create.php" class="btn btn-info w-100 py-3">
                                <i class="fas fa-plus fa-lg"></i><br>
                                <small>Artikel Baru</small>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="../auth/logout.php" class="btn btn-danger w-100 py-3">
                                <i class="fas fa-sign-out-alt fa-lg"></i><br>
                                <small>Logout</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
