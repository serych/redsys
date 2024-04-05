<?php
session_start();
echo "<!DOCTYPE html>\n";
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors',1);
include "config.php";
?>
<html>
<head>
<title>Článek</title>
</head>
<body>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Ověření přihlášení uživatele
if (!isset($_SESSION['user'])) {
  echo "<p>User: NEPŘIHLÁŠEN</p>\n";
  echo "<p><a href=\"login.php\">Přihlášení</a></p>\n";  
} else {
  echo "<p>User: $_SESSION[user]</p>\n";
  echo "<p><a href=\"logout.php\">Odhlášení</a></p>\n"; 
}
  
  $sql="SELECT * FROM clanky where id=$_GET[fid]";
  $result = $conn->query($sql);
 
//print_r($result);
if ($result->num_rows<1) {
    die("<p><i><b>Článek s daným ID neexistuje</b></i></p>\n");
}
$row = $result->fetch_assoc(); 
echo "<h2>$row[nazev]</h2>\n";
echo "<p>$row[obsah]</p>\n";
echo "<p><a href=\"edituj.php?fid=$row[id]\">Upravit článek</a></p>\n";
echo "<p><a href=\"smazej.php?fid=$row[id]\">Smazat článek</a></p>\n";
echo "<p><a href=\"index.php\">Hlavní stránka</a></p>\n"; 

?>
</body>
</html>