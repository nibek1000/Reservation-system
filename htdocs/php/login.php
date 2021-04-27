<?php
   ob_start();
   ini_set('session.gc_maxlifetime', 60);
   session_set_cookie_params(60);
   session_start();
   $czyZalogowany = isset($_SESSION["login"]);
   if($czyZalogowany){
      header("Location: admin.php");
   }
?>

<html lang = "en">
   <head>
   <link rel="stylesheet" type="text/css" href="../css/style.css">
   <link rel="icon" type="image/png" href="../assets/logo.png"/>
   <title>Reservation - logIn</title>

   </head>
   <body>
      <div class = "container form-signin">
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
                  
                  if($_POST['option'] == "LogIn"){
                     $connect = mysqli_connect("localhost", "root", "", "reservation");

                     if($connect === false){
                     die("ERROR: Could not connect. " . mysqli_connect_error());
                     }

                     $sql = "SELECT * FROM `admins`";

                     $result = $connect->query($sql);

                     if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                              $pass = password_verify($_POST['password'], $row["password"]);
                              
                              if ($_POST['username'] == $row["login"] && $pass == true ) {
                                 $_SESSION["login"] = $_POST['username'];
                                 header("Location: admin.php");
                              }else {
                                 $msg = 'Niepoprawne dane';
                              }
                        }
                     }
                  }else{
                     $connect = mysqli_connect("localhost", "root", "", "reservation");

                     if($connect === false){
                     die("ERROR: Could not connect. " . mysqli_connect_error());
                     }
                     $haslo = password_hash($_POST['password'], PASSWORD_DEFAULT);
                     $login = $_POST['username'];
                     $sql = "INSERT INTO `admins` (`id`, `login`, `password`) VALUES ('', '$login', '$haslo')";

                     if(mysqli_query($connect, $sql)){
                        echo "Account created";
                     } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
                     } 
                  }
                
            }
         ?>
      </div>
      
      
         <form class = "form-signin" role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            
         <div class="loginForm">
            Login to admin panel
            <select name="option" class="loginorregister">
                <option>LogIn</option>
                <option disabled>Register - you need to enable this option in code</option>
            </select>
            <br>
            <input type = "text" class = "inputLogin" name = "username" placeholder = "Login" required autofocus></br>
            <input type = "password" class = "inputLogin" name = "password" placeholder = "Hasło" required><br>
            <button class="Loginbutton" type = "submit" name = "login">Do it</button>
         </div>        
         </form>
   </body>
</html>