<?php

include "db.php"; 

if (!isset($_COOKIE['user_id'])) {
    exit("Ошибка: доступ запрещен. Пожалуйста, авторизуйтесь.");
}

$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type == "goods") {
    $good_name = trim($_POST['good_name']);
    $good_img = trim($_POST['good_img']);
    $good_price = trim($_POST['good_price']);
    $good_description = trim($_POST['good_description']);
    $availability = (int)$_POST['availability'];
    $new_genres = isset($_POST['genres']) ? $_POST['genres'] : [];

    $stmt = $sql->prepare("INSERT INTO `goods` (`good_name`, `good_img`, `good_description`, `good_price`, `good_availability`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $good_name, $good_img, $good_description, $good_price, $availability);
    $stmt->execute();
    
    $good_id = $sql->insert_id;

    if (!empty($new_genres)) {
        $stmt_genre = $sql->prepare("INSERT INTO `manga_genre` (`g_manga_id`, `m_genre_id`) VALUES (?, ?)");
        foreach ($new_genres as $genre_id) {
            $stmt_genre->bind_param("ii", $good_id, $genre_id);
            $stmt_genre->execute();
        }
        $stmt_genre->close();
    }
    
    $stmt->close();
} 
elseif ($type == 'genres') {
    $genre_name = trim($_POST['genre_name']);
    $stmt = $sql->prepare("INSERT INTO `genres` (`genre_name`) VALUES (?)");
    $stmt->bind_param("s", $genre_name);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'adresess') {
    $adreses_name = trim($_POST['adreses_name']);
    $user_id = (int)$_COOKIE['user_id'];
    
    $stmt = $sql->prepare("INSERT INTO `adresess` (`adreses_name`, `adreses_user`) VALUES (?, ?)");
    $stmt->bind_param("si", $adreses_name, $user_id);
    $stmt->execute();
    $stmt->close();
    
    header("location: /pages/profile.php?type=adress");
    exit(); 
}
elseif ($type == 'promocodes') {
    $promocod_name = trim($_POST['promocod_name']);
    $promocod_percent = (int)$_POST['promocod_percent'];
    $percent_livetime = $_POST['percent_livetime'];

    $stmt = $sql->prepare("INSERT INTO `promocodes` (`promocod_name`, `promocod_percent`, `percent_livetime`) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $promocod_name, $promocod_percent, $percent_livetime);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'banner_hits' || $type == 'banner_news' || $type == 'banner_season') {
    $manga_id = (int)$_POST['manga_id'];
    $manga_img = trim($_POST['manga_img']);
    $manga_desc = trim($_POST['manga_desc']);

    if ($type == 'banner_hits') {
        $table = 'banner_hits';
        $id_col = 'hits_manga_id';
        $img_col = 'hits_manga_img';
        $desc_col = 'hits_manga_desc';
    } elseif ($type == 'banner_news') {
        $table = 'banner_news';
        $id_col = 'new_manga_id';
        $img_col = 'new_manga_img';
        $desc_col = 'new_manga_desc';
    } else { 
        $table = 'banner_season';
        $id_col = 'season_manga_id';
        $img_col = 'season_manga_img';
        $desc_col = 'season_manga_desc';
    }
    
    $stmt = $sql->prepare("INSERT INTO `$table` (`$id_col`, `$img_col`, `$desc_col`) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $manga_id, $manga_img, $manga_desc);
    $stmt->execute();
    $stmt->close();
}

$sql->close();
header("location: /pages/profile.php?type=$type");
?>