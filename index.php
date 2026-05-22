<?php

require 'config/database.php';
require 'layouts/header.php';

$query = mysqli_query($conn, "
    SELECT
        posts.*,
        categories.name as category_name
    FROM posts

    LEFT JOIN categories
    ON posts.category_id = categories.id

    ORDER BY posts.id DESC
");

?>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="display-4 text-gradient mb-2">
                <i class="fas fa-newspaper"></i> Blog Terbaru
            </h1>
            <p class="text-muted fs-5">Temukan artikel dan cerita menarik dari penulis kami</p>
        </div>
    </div>

    <div class="row">

<?php while($post = mysqli_fetch_assoc($query)) : ?>

    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100">

            <div class="card-body d-flex flex-column">

                <span class="badge bg-primary mb-3" style="width: fit-content;">
                    <i class="fas fa-tag"></i> <?= $post['category_name'] ?>
                </span>

                <h5 class="card-title mb-3">
                    <?= substr($post['title'], 0, 50) ?>
                </h5>

                <small class="text-muted mb-3">
                    <i class="far fa-calendar"></i> <?= date('d M Y', strtotime($post['created_at'])); ?>
                </small>

                <p class="card-text flex-grow-1">

                    <?= substr($post['content'], 0, 100) ?>...

                </p>

                <a href="post.php?id=<?= $post['id'] ?>"
                   class="btn btn-primary mt-auto">

                    <i class="fas fa-arrow-right"></i> Baca Selengkapnya

                </a>

            </div>

        </div>

    </div>

<?php endwhile; ?>

    </div>
</div>

<?php require 'layouts/footer.php'; ?>