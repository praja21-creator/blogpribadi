<?php

require '../config/database.php';

$id          = $_POST['id'];
$title       = $_POST['title'];
$content     = $_POST['content'];
$category_id = $_POST['category_id'];

mysqli_query($conn, "
    UPDATE posts
    SET
        title = '$title',
        content = '$content',
        category_id = '$category_id'
    WHERE id = '$id'
");

header("Location: index.php");