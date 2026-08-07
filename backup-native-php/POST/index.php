<?php

require '../config/database.php';
include '../layouts/header.php';
$query = mysqli_query($conn, "SELECT posts.*, categories.name as category_name
FROM posts
LEFT JOIN categories 
ON posts.category_id = categories.id");
?>

<h1>Data Artikel</h1>

<a href="create.php" class="btn btn-primary mb-3">Tambah Artikel</a>

<table class="table table-bordered">
    
<?php $no = 1; ?>
<?php while($post = mysqli_fetch_assoc($query)) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $post['title']; ?></td>
        <td><?= $post['category_name']; ?></td>
        <td>
            <a href="edit.php?id=<?= $post['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="delete.php?id=<?= $post['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../layouts/footer.php'; ?>