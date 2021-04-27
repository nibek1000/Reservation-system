<?php
session_start();
$login = $_SESSION["login"];
setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();
echo '
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="icon" type="image/png" href="../assets/logo.png"/>
<title>Reservation - logout</title>

<script>
var dots = window.setInterval( function() {
    var wait = document.getElementById("wait");
    if ( wait.innerHTML.length > 3 ) 
        wait.innerHTML = "";
    else 
        wait.innerHTML += ".";
    }, 500);
</script>
';

echo '<center><span class="logoutSpan">Logging out: '.$login.'</span><span id="wait" class="logoutSpan"></span>';

echo '<br><button class="button" onclick='. "'". 'window.open("../index.html","_self")'. "'" .'>Go to index</button></center>';
?>