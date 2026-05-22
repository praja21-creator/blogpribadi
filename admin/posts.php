<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../config/database.php';
require '../layouts/header.php';

$query = mysqli_query($conn, "SELECT posts.*, categories.name as category_name
FROM posts
LEFT JOIN categories 
ON posts.category_id = categories.id
ORDER BY posts.id DESC");

?>

<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-8">
            <h1>Kelola Artikel</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="../POST/create.php" class="btn btn-success">+ Buat Artikel Baru</a>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= $_GET['success']; ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th width="40%">Judul</th>
                    <th width="25%">Kategori</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($post = mysqli_fetch_assoc($query)): 
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= substr($post['title'], 0, 50); ?>...</td>
                        <td><span class="badge bg-info"><?= $post['category_name']; ?></span></td>
                        <td><?= date('d-m-Y', strtotime($post['created_at'])); ?></td>
                        <td>
                            <a href="../POST/edit.php?id=<?= $post['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../POST/delete.php?id=<?= $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
