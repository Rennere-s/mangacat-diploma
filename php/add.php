<?php
include "db.php";
$type = $_GET['type'];
if ($type == "goods") {
    $good_name = filter_var(trim($_POST['good_name']));
    $good_img = filter_var(trim($_POST['good_img']));
    $good_back_img = filter_var(trim($_POST['good_back_img']));
    $good_price = filter_var(trim($_POST['good_price']));
    $good_description = filter_var(trim($_POST['good_description']));
    $availability = filter_var(trim($_POST['availability']));
    $new_genres = $_POST['genres'];

    $sql->query("INSERT INTO `goods` (`good_name`, `good_img`, `good_back_img`, `good_description`, `good_price`, `good_availability`) VALUES ('$good_name', '$good_img', '$good_back_img', '$good_description', '$good_price', '$availability')");

    $good_id = $sql->insert_id;

    if (isset($new_genres)) {
        foreach ($new_genres as $genre => $value) {
            $sql->query("INSERT INTO `manga_genre` (`g_manga_id`, `m_genre_id`) VALUES ('$good_id', '$value')");
        }
    }
    $sql->close();
} elseif ($type == 'genres') {
    $genre_name = filter_var(trim($_POST['genre_name']));
    $sql->query("INSERT INTO `genres` (`genre_name`) VALUES ('$genre_name')");
    $sql->close();
}
header("location: /pages/profile.php?type=$type");
?>