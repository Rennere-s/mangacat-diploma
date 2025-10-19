<?php
setcookie('user_id', $user['user_id'], time() - 3600, '/');
setcookie('user_login', $user['user_login'], time() - 3600, '/');
setcookie('user_role', $user['user_role'], time() - 3600, '/');
echo "<script>window.location.replace('/');</script>";


?>