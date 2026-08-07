<?php

require '../config/database.php';
require '../layouts/header.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT * FROM posts
    WHERE id = '$id'
");

$post = mysqli_fetch_assoc($query);

$categories = mysqli_query($conn, "
    SELECT * FROM categories
");

?>

<h1>Edit Artikel</h1>

<form action="update.php" method="POST">

    <input type="hidden"
           name="id"
           value="<?= $post['id'] ?>">

    <div class="mb-3">
        <label>Judul</label>

        <input type="text"
               name="title"
               class="form-control"
               value="<?= $post['title'] ?>">
    </div>

    <div class="mb-3">
        <label>Kategori</label>

        <select name="category_id"
                class="form-control">

            <?php while($category = mysqli_fetch_assoc($categories)) : ?>

                <option
                    value="<?= $category['id'] ?>"

                    <?= $category['id'] == $post['category_id']
                        ? 'selected'
                        : '' ?>

                >
                    <?= $category['name'] ?>
                </option>

            <?php endwhile; ?>

        </select>
    </div>

    <div class="mb-3">
        <label>Konten</label>

        <textarea name="content"
                  class="form-control"
                  rows="5"><?= $post['content'] ?></textarea>
    </div>

    <button class="btn btn-primary">
        Update Artikel
    </button>

</form>

<?php require '../layouts/footer.php'; ?>