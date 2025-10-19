<?php

include "db.php"; 

if (!isset($_COOKIE['user_id'])) {
    exit("Ошибка: доступ запрещен. Пожалуйста, авторизуйтесь.");
}

$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type == "goods") {
    $good_id = (int) $_POST['good_id'];
    $good_name = trim($_POST['good_name']);
    $good_img = trim($_POST['good_img']);
    $good_price = trim($_POST['good_price']);
    $good_description = trim($_POST['good_description']);
    $good_availability = (int) $_POST['availability'];
    $new_genres = isset($_POST['genres']) ? $_POST['genres'] : [];

    $stmt = $sql->prepare("UPDATE `goods` SET `good_name` = ?, `good_img` = ?, `good_description` = ?, `good_price` = ?, `good_availability` = ? WHERE `good_id` = ?");
    $stmt->bind_param("ssssii", $good_name, $good_img, $good_description, $good_price, $good_availability, $good_id);
    $stmt->execute();
    $stmt->close();

    $sql->query("DELETE FROM `manga_genre` WHERE `g_manga_id` = '$good_id'");
    if (!empty($new_genres)) {
        $stmt_genre = $sql->prepare("INSERT INTO `manga_genre` (`g_manga_id`, `m_genre_id`) VALUES (?, ?)");
        foreach ($new_genres as $genre_id) {
            $stmt_genre->bind_param("ii", $good_id, $genre_id);
            $stmt_genre->execute();
        }
        $stmt_genre->close();
    }
}
elseif ($type == 'genres') {
    $genre_id = (int) $_POST['genre_id'];
    $genre_name = trim($_POST['genre_name']);

    $stmt = $sql->prepare("UPDATE `genres` SET `genre_name` = ? WHERE `genre_id` = ?");
    $stmt->bind_param("si", $genre_name, $genre_id);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'users') {
    $user_id = (int) $_POST['user_id'];

    if ($_COOKIE['user_role'] != 2 && $_COOKIE['user_id'] != $user_id) {
        exit("Ошибка: у вас нет прав для выполнения этого действия.");
    }

    $user_login = trim($_POST['user_login']);
    $user_tel = trim($_POST['user_tel']);
    $user_email = trim($_POST['user_email']);
    $user_date = trim($_POST['user_date']);

    $query_parts = ["`user_login` = ?", "`user_tel` = ?", "`user_email` = ?", "`user_date` = ?"];
    $params = [$user_login, $user_tel, $user_email, $user_date];
    $types = "ssss";

    if (!empty($_POST['user_password_new']) && $_COOKIE['user_id'] == $user_id) {
        if ($_POST['user_password_new'] === $_POST['user_password_confirm']) {
            $hashed_password = md5($_POST['user_password_new']); 
            $query_parts[] = "`user_password` = ?";
            $params[] = $hashed_password;
            $types .= "s";
        }
    }

    if (isset($_POST['user_role']) && $_COOKIE['user_role'] == 2) {
        $user_role = (int) $_POST['user_role'];
        $query_parts[] = "`user_role` = ?";
        $params[] = $user_role;
        $types .= "i";
    }

    $params[] = $user_id; 
    $types .= "i";

    $query = "UPDATE `users` SET " . implode(", ", $query_parts) . " WHERE `user_id` = ?";

    $stmt = $sql->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'reviews') {
    if ($_COOKIE['user_role'] != 2) {
        exit("Ошибка: доступ запрещен.");
    }

    $review_id = (int) $_POST['review_id'];
    $review_text = trim($_POST['review_text']);
    $review_status = (int) $_POST['review_status'];

    $stmt = $sql->prepare("UPDATE `reviews` SET `review_text` = ?, `review_status` = ? WHERE `review_id` = ?");
    $stmt->bind_param("sii", $review_text, $review_status, $review_id);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'adresess') {
    $adreses_id = (int) $_POST['adreses_id'];
    $adreses_name = trim($_POST['adreses_name']);
    $user_id = (int) $_COOKIE['user_id'];

    $stmt = $sql->prepare("UPDATE `adresess` SET `adreses_name` = ? WHERE `adreses_id` = ? AND `adreses_user` = ?");
    $stmt->bind_param("sii", $adreses_name, $adreses_id, $user_id);
    $stmt->execute();
    $stmt->close();

    header("location: /pages/profile.php?type=adress");
    exit();
}
elseif ($type == 'orders') {
    if ($_COOKIE['user_role'] != 2) {
        exit("Ошибка: доступ запрещен.");
    }

    $order_id = (int) $_POST['order_id'];
    $status_id = (int) $_POST['status_id']; 

    $stmt = $sql->prepare("UPDATE `orders` SET `status_id` = ? WHERE `order_id` = ?");
    $stmt->bind_param("ii", $status_id, $order_id);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'promocodes') {
    $promocod_id = (int) $_POST['promocod_id'];
    $promocod_name = trim($_POST['promocod_name']);
    $promocod_percent = (int) $_POST['promocod_percent'];
    $percent_livetime = $_POST['percent_livetime'];

    $stmt = $sql->prepare("UPDATE `promocodes` SET `promocod_name` = ?, `promocod_percent` = ?, `percent_livetime` = ? WHERE `promocod_id` = ?");
    $stmt->bind_param("sisi", $promocod_name, $promocod_percent, $percent_livetime, $promocod_id);
    $stmt->execute();
    $stmt->close();
}
elseif ($type == 'banner_hits' || $type == 'banner_news' || $type == 'banner_season') {
    $manga_id = (int) $_POST['manga_id'];
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

    $stmt = $sql->prepare("UPDATE `$table` SET `$img_col` = ?, `$desc_col` = ? WHERE `$id_col` = ?");
    $stmt->bind_param("ssi", $manga_img, $manga_desc, $manga_id);
    $stmt->execute();
    $stmt->close();
}

$sql->close();
header("location: /pages/profile.php?type=$type");
?>