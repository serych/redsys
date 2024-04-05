<?php
session_start();
echo "<!DOCTYPE html>\n";
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors',1);
include "config.php";
?>
<html>
<head>
<title>Redakční systém</title>
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
//echo "Connected successfully<br>\n";
if ($_SERVER['REQUEST_METHOD']=="POST") {
  if ($_POST["fid"]>0) {
    // Tady vložíme do db
    $sql="UPDATE `clanky` SET
    `nazev` = '$_POST[fnazev]',
    `obsah` = '$_POST[fobsah]'
    WHERE `id` = '$_POST[fid]'";
  } else if ($_POST["fid"]==0){
    // Tady vytvoříme článek
    $sql="INSERT INTO `clanky` (`nazev`, `obsah`, `autor`)
    VALUES ('$_POST[fnazev]', '$_POST[fobsah]', '1')";
  } else {
    $mid=-$_POST["fid"];
    $sql="DELETE FROM `clanky`
        WHERE ((`id` = '$mid'))";
  }
  $result = $conn->query($sql);
}
$sql="SELECT * FROM clanky";
$result = $conn->query($sql);
if ($conn->errno==1146) {
//  Neexistuje tabulka clanky. Vytvoříme ji a taky tabulku uzivatele
  $sql="CREATE TABLE `clanky` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nazev` varchar(120) NOT NULL,
    `obsah` varchar(2048) NOT NULL,
    `autor` int(11) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci";
  $result = $conn->query($sql);
  echo "<p>Vytvářím tabulku clanky...</p>\n";
  $sql="CREATE TABLE `uzivatele` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user` varchar(20) NOT NULL,
    `pass` varchar(255) NOT NULL,
    `prava` int(11) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci";
  $result = $conn->query($sql);
  echo "<p>Vytvářím tabulku uzivatele...</p>\n";
  
  $sql="SELECT * FROM clanky";
  $result = $conn->query($sql);
} 
if ($result->num_rows<1) {
    die("<p><i><b>Zatím nemáme žádné články</b></i></p>\n 
        <p><a href=\"edituj.php?fid=0\">Přidat článek</a></p>");
}
while($row = $result->fetch_assoc()) { 
    // Obsah si dáme zbavený HTML tagů do své proměnné
    $celytext= strip_tags($row["obsah"]);
    if (strlen($celytext) < 100){ //pokud je text dostatečně krátký
        // vypíšeme klikací nadpis
        echo "<h2><a href=\"clanek.php?fid=$row[id]\">$row[nazev]</a></h2>\n";
        // vypíšeme obsah 
        echo "<p>$celytext</p>\n";
    } else {  // text je delší než 100 znaků
        // vypíšeme neklikací nadpis
        echo "<h2>$row[nazev]</h2>\n";
        // Hledáme mezeru před stým znakem
        $mezera = strpos($celytext, " ", -strlen($celytext)+101);
        // vypíšeme zkrácený text s odkazem 
        echo "<p>". substr($celytext,0, $mezera) . " <a href=\"clanek.php?fid=$row[id]\">číst dále ...</a>\n";     
    }    
}
echo "<p><a href=\"edituj.php?fid=0\">Přidat článek</a></p>";

?>
</body>
</html>