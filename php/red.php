<?php
include "db.php";
$type = $_GET['type'];
if ($type == "goods") {
    $good_id = filter_var(trim($_POST['good_id']));
    $good_name = filter_var(trim($_POST['good_name']));
    $good_img = filter_var(trim($_POST['good_img']));
    $good_back_img = filter_var(trim($_POST['good_back_img']));
    $good_price = filter_var(trim($_POST['good_price']));
    $good_description = filter_var(trim($_POST['good_description']));
    $good_availability = filter_var(trim($_POST['availability']));
    $new_genres = $_POST['genres'];

    $sql->query("UPDATE `goods` SET `good_name` = '$good_name', `good_img` = '$good_img', `good_back_img` = '$good_back_img', `good_description` = '$good_description', `good_price` = '$good_price', `good_availability` = '$good_availability' WHERE `good_id` = '$good_id'");

    $good_genres_sql = $sql->query("SELECT `m_genre_id` FROM `manga_genre` WHERE `g_manga_id` = '$good_id'");
    while ($row = mysqli_fetch_assoc($good_genres_sql)) {
        $good_genres[] = $row['m_genre_id'];
    }

    if (isset($good_genres)) {
        $genresToRemove = array_diff($good_genres, $new_genres);
        $genresToAdd = array_diff($new_genres, $good_genres);

        if (isset($genresToRemove)) {
            foreach ($genresToRemove as $genre => $value) {
                $sql->query("DELETE FROM `manga_genre` WHERE `g_manga_id` = '$good_id' AND `m_genre_id` = '$value'");
            }
        }
        if (isset($genresToAdd)) {
            foreach ($genresToAdd as $genre => $value) {
                $sql->query("INSERT INTO `manga_genre` (`g_manga_id`, `m_genre_id`) VALUES ('$good_id', '$value')");
            }
        }
    } else {
        if (isset($new_genres)) {
            foreach ($new_genres as $genre => $value) {
                $sql->query("INSERT INTO `manga_genre` (`g_manga_id`, `m_genre_id`) VALUES ('$good_id', '$value')");
            }
        }
    }

    $sql->close();
} elseif ($type == 'genres') {
    $genre_id = filter_var(trim($_POST['genre_id']));
    $genre_name = filter_var(trim($_POST['genre_name']));
    // echo $genre_id.' '.$genre_name;
    $sql->query("UPDATE `genres` SET `genre_name` = '$genre_name' WHERE `genre_id` = '$genre_id'");
    $sql->close();
} elseif ($type == 'users') {
    $user_id = filter_var(trim($_POST['user_id']));
    $user_role = filter_var(trim($_POST['user_role']));
    // echo $user_id.' '.$user_role; 
    $sql->query("UPDATE `users` SET `user_role` = '$user_role' WHERE `user_id` = '$user_id'");
    $sql->close();
}
header("location: /pages/profile.php?type=$type");


?>