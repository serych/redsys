<?php
session_start();
echo "<!DOCTYPE html>\n";
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors',1);
include "config.php";
?>
<html>
<head>
<title>Odhlášení uživatele</title>
</head>
<body>
<?php
session_unset();
session_destroy();
//automatický skok na index.php
header('Location: index.php');
?>
</body>
</html>
