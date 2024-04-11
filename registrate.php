<?php
require_once "uvod.php";
?>
<html>
<head>
<title>Registrace uživatele</title>
</head>
<body>
<?php
require_once "dbopen.php";

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
  echo "<form method=\"POST\" action=\"registrate.php\">
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
