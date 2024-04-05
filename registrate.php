<!DOCTYPE html>
<?php
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors',1);
include "config.php";
?>
<html>
<head>
<title>Registrace uživatele</title>
</head>
<body>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD']=="POST") { // do stránky jsme vlezli metodou POST
  // Tady vložíme uživatele do db
  $pass_hash = password_hash($_POST["fpass"], PASSWORD_DEFAULT);
  $sql="INSERT INTO `uzivatele` (`user`, `pass`, `prava`)
  VALUES ('$_POST[fuser]', '$pass_hash', 1)";   
  $result = $conn->query($sql);
  $conn->close();
  //automatický skok na index.php
  header('Location: index.php');
} else {  // do stránky jsme vlezli metodou GET - vypíšeme formulář
  echo "<form method=\"POST\" action=\"register.php\">
    Username: 
    <input type=\"text\" name=\"fuser\"><br>
    Password: 
    <input type=\"password\" name=\"fpass\"><br><br>
    <input type=\"submit\" value=\"Registrovat\">
  </form>";
}
?>
</body>
</html>
