<?php
require_once "uvod.php";
?>
<html>
<head>
<title>Smazání článku</title>
</head>
<body>
<?php
require_once "dbopen.php";
// Ověření přihlášení uživatele
if (!isset($_SESSION['user'])) {
  echo "<h2>Pro smazání článku musí být uživatel přihlášen!</h2>\n";
  echo "<p><a href=\"login.php\">Přihlášení</a></p>\n";  
} else {
  $sql="SELECT * FROM clanky where id=$_GET[fid]";
  $result = $conn->query($sql);
  if ($result->num_rows<1) {  
    die("<p><i><b>Článek s daným ID neexistuje</b></i></p>\n");
  }
  $row = $result->fetch_assoc();
  echo "<h2>Opravdu chcete smazat článek $row[nazev]?</h2>\n";
  
  echo "<form method=\"POST\" action=\"index.php\">
    <input type=\"hidden\" name=\"fid\" value=\"-$row[id]\">
    <input type=\"submit\" value=\"Ano\">
  </form>";
  echo "<form method=\"GET\" action=\"index.php\">
    <input type=\"submit\" value=\"Ne\">
  </form>";
} 
?>
</body>
</html>