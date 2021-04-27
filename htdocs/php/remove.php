<?php
session_start();
$login = $_SESSION["login"];
if($login == ""){
    header("Location: ../noAccess.html");
}else{


$connect = mysqli_connect("localhost", "root", "", "reservation");

echo '
<script>
function przenies() {
  window.close();
}
</script>
';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';

if($connect === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$urlPath = $_SERVER["REQUEST_URI"];

$id = array_slice(explode('/', rtrim($urlPath, '/')), -1)[0];

$sql = "DELETE FROM `reservations` WHERE `id`=$id";
if(mysqli_query($connect, $sql)){
    echo "Usunieto";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
}

echo '<script>alert("Usunieto");window.close();</script>';
}

?>