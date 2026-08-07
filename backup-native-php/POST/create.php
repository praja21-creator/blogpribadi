<?php

require '../config/database.php';
require '../layouts/header.php';

$categories = mysqli_query($conn, "SELECT * FROM categories
");

?>

<h1>Tambah Artikel</h1>

<form action="store.php" method="POST">

    <div class="mb-3">
        <label>Judul</label>

        <input type="text"
               name="title"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Kategori</label>

        <select name="category_id" class="form-control">

            <?php while($category = mysqli_fetch_assoc($categories)) : ?>

                <option value="<?= $category['id'] ?>">
                    <?= $category['name'] ?>
                </option>

            <?php endwhile; ?>

        </select>
    </div>

    <div class="mb-3">
        <label>Konten</label>

        <textarea name="content"
                  class="form-control"
                  rows="5"></textarea>
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

<?php require '../layouts/footer.php'; ?>