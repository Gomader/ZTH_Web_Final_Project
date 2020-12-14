<?php
session_start();
$_SESSION = array();
if(isset($_COOKIE[session_name()])) {
setCookie(session_name(), "", time()-42000, "/");
}
session_destroy();
echo '<meta http-equiv = "refresh"; content = "1;url = ../index.php">';
?>