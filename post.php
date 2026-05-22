<?php

require 'config/database.php';
require 'layouts/header.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT
        posts.*,
        categories.name as category_name

    FROM posts

    LEFT JOIN categories
    ON posts.category_id = categories.id

    WHERE posts.id = '$id'
");

$post = mysqli_fetch_assoc($query);

?>

<div class="row justify-content-center">

    <div class="col-md-8">

        <span class="badge bg-dark mb-3">
            <?= $post['category_name'] ?>
        </span>

        <h1>
            <?= $post['title'] ?>
        </h1>

        <small class="text-muted">
            <?= $post['created_at'] ?>
        </small>

        <hr>

        <p style="line-height: 30px;">

            <?= nl2br($post['content']) ?>

        </p>

        <a href="index.php"
           class="btn btn-secondary mt-3">

            Kembali

        </a>

    </div>

</div>

<?php require 'layouts/footer.php'; ?>