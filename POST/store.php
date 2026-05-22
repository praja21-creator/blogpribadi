<?php

require '../config/database.php';

$title       = $_POST['title'];
$content     = $_POST['content'];
$category_id = $_POST['category_id'];

mysqli_query($conn, "
    INSERT INTO posts(title, content, category_id)
    VALUES('$title', '$content', '$category_id')
");

header("Location: index.php");