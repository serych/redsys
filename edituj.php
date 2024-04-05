<?php
session_start();
echo "<!DOCTYPE html>\n";
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors',1);
include "config.php";
?>
<html>
<head>
<script src="/php-pa/ckeditor/ckeditor.js"></script>
<title>Úpravy</title>
</head>
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
    if ($_GET["fid"]!=0) {
        die("<p><i><b>Článek s daným ID neexistuje</b></i></p>\n");
    } 
}
if ($_GET["fid"]!=0) {
  $row = $result->fetch_assoc(); 
  echo "<form method=\"POST\" action=\"index.php\">
    <input type=\"hidden\" name=\"fid\" value=\"$row[id]\">
    Název:<br>
    <input type=\"text\" name=\"fnazev\" value=\"$row[nazev]\"><br>
    Obsah:<br>
    <textarea id=\"obsah\" name=\"fobsah\" rows=\"10\" cols=\"50\">$row[obsah]</textarea>
    <br><br>
    <input type=\"submit\" value=\"Uložit změny\">
  </form>";
} else {    // zakládáme nový článek
  echo "<form method=\"POST\" action=\"index.php\">
    <input type=\"hidden\" name=\"fid\" value=\"0\">
    Název:<br>
    <input type=\"text\" name=\"fnazev\"><br>
    Obsah:<br>
    <textarea id=\"obsah\" name=\"fobsah\" rows=\"10\" cols=\"50\"></textarea>
    <br><br>
    <input type=\"submit\" value=\"Uložit\">
  </form>";
}

echo "<p><a href=\"index.php\">Hlavní stránka</a></p>\n"; 

?>

<script>
    CKEDITOR.replace('obsah');
</script>
</body>
</html>