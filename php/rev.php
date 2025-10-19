<?php
$back = $_SERVER['HTTP_REFERER'];
$review_user = $_COOKIE['user_id'];
$review_manga = filter_var(trim($_POST['review_manga']));
$review_text = filter_var(trim($_POST['review_text']));
$review_rating = filter_var(trim($_POST['review_rating']));
$review_date = date('Y-m-d H:i:s');


include "db.php";

$sql->query("INSERT INTO `reviews` (`review_user`, `review_manga`, `review_text`, `review_rating`, `review_date`, `review_status`) VALUES ('$review_user', '$review_manga', '$review_text', '$review_rating', '$review_date', 1)");
$sql->close();

header("Location: $back");

?>