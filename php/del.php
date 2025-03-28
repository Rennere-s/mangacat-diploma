<?php

$type = filter_var(trim($_GET['type']), FILTER_SANITIZE_STRING);
$id = filter_var(trim($_GET['id']), FILTER_VALIDATE_INT);
$type_id = filter_var(trim($_GET['type_id']), FILTER_SANITIZE_STRING);


// echo $id.' '.$type.' '.$type_id;
include 'db.php';

if ($type == "goods") {
    $genres = $sql->query("SELECT m_genre_id FROM `manga_genre` WHERE g_manga_id = '$id'");
    while ($row = mysqli_fetch_assoc($genres)) {
        $genre_id = $row['m_genre_id'];
        $sql->query("DELETE FROM `manga_genre` WHERE m_genre_id = '$genre_id'");
    }
}

$sql->query("DELETE FROM `$type` WHERE `$type_id` = '$id'");

$sql->close();
header("location: /pages/profile.php?type=$type");


?>