<?php

require '../config/database.php';

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM posts
    WHERE id = '$id'
");

header("Location: index.php");