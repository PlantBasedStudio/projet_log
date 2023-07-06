<?php
session_start();
unset($_SESSION['roles']);
session_unset();

session_destroy();
header('Location: ./login.php');
exit();

?>
!