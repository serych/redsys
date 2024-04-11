<?php
require_once "uvod.php";
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
