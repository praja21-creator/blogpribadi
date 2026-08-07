<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../config/database.php';

// Handle tambah kategori
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    if(!empty($name)) {

        $slug = strtolower($name);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

        $insert = mysqli_query($conn,
            "INSERT INTO categories(name, slug)
             VALUES('$name', '$slug')"
        );

        if($insert) {
            header('Location: index.php?success=Kategori berhasil ditambahkan');
            exit();
        }
    }
}

// Handle edit kategori
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {

    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    if(!empty($name) && $id > 0) {

        $slug = strtolower($name);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

        $update = mysqli_query($conn,
            "UPDATE categories
             SET name = '$name', slug = '$slug'
             WHERE id = $id"
        );

        if($update) {
            header('Location: index.php?success=Kategori berhasil diupdate');
            exit();
        }
    }
}

require '../layouts/header.php';

$query = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>

<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-8">
            <h1>Kelola Kategori</h1>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Tambah Kategori</button>
            <a href="../admin/index.php" class="btn btn-secondary">Kembali</a>
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
                    <th width="10%">No</th>
                    <th width="60%">Nama Kategori</th>
                    <th width="30%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($category = mysqli_fetch_assoc($query)): 
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $category['name']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?= $category['id']; ?>">Edit</button>
                            <a href="../categories/delete.php?id=<?= $category['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal Edit Kategori -->
                    <div class="modal fade" id="editCategoryModal<?= $category['id']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kategori</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="" method="POST">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="id" value="<?= $category['id']; ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_name<?= $category['id']; ?>" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control" id="edit_name<?= $category['id']; ?>" name="name" value="<?= htmlspecialchars($category['name']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
