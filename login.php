<?php
require_once "uvod.php";
?>
<html>
<head>
<title>Přihlášení uživatele</title>
</head>
<body>
<?php
require_once "dbopen.php";

if ($_SERVER['REQUEST_METHOD']=="POST") { // do stránky jsme vlezli metodou POST
  // Tady vložíme do db
  $sql = "SELECT * FROM `uzivatele` WHERE `user` = '$_POST[fuser]'";
  $result = $conn->query($sql);
  if ($result->num_rows<1) {  //Uživatel neexistuje
    echo "<p>Uživatel $_POST[fuser] neexistuje! Chcete se zaregistrovat?</p>\n";
    echo "<p><a href=\"registrate.php\">Registrace</a></p>";
  } else {   // uživatel nalezen, uvidíme, jestli zná heslo
    $row = $result->fetch_assoc();
    if (password_verify($_POST["fpass"], $row["pass"])) { // správné heslo
      $_SESSION['user'] = $_POST["fuser"];
      echo "<p>Heslo OK!</p>\n";
      //automatický skok na index.php
      header('Location: index.php');
    } else {  //nezná heslo
      echo "<p>Špatné heslo! Chcete to zkusit znova?</p>\n";
      echo "<p><a href=\"login.php\">Přihlášení</a></p>";      
    } 
  }
   $conn->close();
} else {  // do stránky jsme vlezli metodou GET
  echo "<form method=\"POST\" action=\"login.php\">
    Username: 
    <input type=\"text\" name=\"fuser\"><br>
    Password: 
    <input type=\"password\" name=\"fpass\"><br><br>
    <input type=\"submit\" value=\"Přihlásit\">
  </form>";
}
?>
</body>
</html>
