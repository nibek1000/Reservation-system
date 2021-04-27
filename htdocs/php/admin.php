<?php
session_start();
$login = $_SESSION["login"];

if($login == ""){
    header("Location: ../noAccess.html");
}

echo '
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="icon" type="image/png" href="../assets/logo.png"/>
<title>Reservation - admin panel</title>

<div class="loginDiv">
    Logged in as: '.$login.'
    <a href="logout.php" class="button">log out</a>
</div> 
';

$connect = mysqli_connect("localhost", "root", "", "reservation");

if($connect === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}


$sql = "SELECT * FROM `reservations` WHERE`Date` > NOW() order by `Date` ASC";

$result = $connect->query($sql);


echo '
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script>
function remove(a){
    var url = "remove.php/" + a;
    window.open(url);
}
</script>
';



echo '
<div><table class="reservationsTable" cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr class="topTable"><th class="id">Id</th><th class="name">Name</th><th class="mail">Email</th><th>Phone</th><th class="date">Date</th><th class="purpose">purpose</th><th class="remove">Remove reservation</th></tr>';

$counter = 0;
if ($result->num_rows > 0) {
  $i = 1;
  while($row = $result->fetch_assoc()) {
    if($i == 1){
      $i--;
      echo '<tr class="st"><th>'. $row["id"]. "</th><th>" . $row["Name"]. "</th><th>" . $row["email"]. '</th><th>'. $row["phone"]. '</th><th>'. $row["Date"]. '</th><th>'. $row["purpose"]. '</th><th><button onclick="remove('. $row["id"] .')" class="Tablebutton">Remove</button></th>';
    }else{
      echo '<tr class="nd"><th>'. $row["id"]. "</th><th>" . $row["Name"]. "</th><th>" . $row["email"]. '</th><th>'. $row["phone"]. '</th><th>'. $row["Date"]. '</th><th>'. $row["purpose"]. '</th><th><button onclick="remove('. $row["id"] .')" class="Tablebutton">Remove</button></th>';
      $i++;
    }
  }
} else {
  echo 'no reservations yet';
}



echo '</thead>
      </table></div>';
?>