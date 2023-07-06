<?php
function protect_montexte($param) {
$param = trim($param);
$param = stripslashes($param);
$param = strip_tags($param);
$param = htmlspecialchars($param);
return $param;
}
?>