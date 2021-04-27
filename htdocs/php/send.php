<?php

  
$connect = mysqli_connect("localhost", "root", "", "reservation");

echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
if($connect === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($connect, $_REQUEST['name']);
$mail = mysqli_real_escape_string($connect, $_REQUEST['mail']);
$phone = mysqli_real_escape_string($connect, $_REQUEST['phone']);
$date = mysqli_real_escape_string($connect, $_REQUEST['date']);
$purpose = mysqli_real_escape_string($connect, $_REQUEST['purpose']);


$sql = "SELECT `Date` FROM `reservations` WHERE `Date`='$date'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    //cannod add appointment

    echo '
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" type="image/png" href="../assets/logo.png"/>
    <title>Reservation - creating reservation...</title>

    <div class="reservedForm"><ul>
    ';

    echo '<h3>😞This time is already reserved. Closest avaliable times to yours are:</h3>';
    $sql = "SELECT `Date` FROM `reservations` WHERE 1";
    $result1 = $connect->query($sql);
    if ($result1->num_rows > 0) {
      $x = 0;
      $i = 1;
      while($row = $result1->fetch_assoc()) {
        $tempDate = strtotime($date) + 60*60*$i;
        $i++;
        $tempDate = date("Y-m-d H:i:s", $tempDate);
        

        $sql = "SELECT `Date` FROM `reservations` WHERE `Date`='$tempDate'";
        $result2 = $connect->query($sql);
        if ($result2->num_rows > 0) {
          
        }else if($x < 5){
          echo '<li>'.$tempDate.'</li>';
          $x++;
        }
      }
    }
    echo '</ul>
    <button class="Loginbutton" onclick="window.close();">Ok, close window</button>
    </div>';
  }
}else{
  //can make appointment
  $sql = "INSERT INTO `reservations` (`id`, `name`, `date`, `email`, `phone`, `purpose`) VALUES ('', '$name', '$date', '$mail', '$phone', '$purpose')";

  if(mysqli_query($connect, $sql)){
      echo "added";
  } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
  }

  echo '<script>alert("Your reservation was made on name: '.$name.'");window.close();</script>';
}
?>