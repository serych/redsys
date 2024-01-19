<!DOCTYPE html>
<html>
<head>
<title>Pokus</title>
</head>
<body>
<h1>Proměnné</h1>
<?php
$prom = 5;
$druha = 2;
echo "Proměnná má hodnotu ", $prom . $druha, "<br>\n";
$prom = "ahoj";
echo "Proměnná má hodnotu ", $prom, "<br>\n";
$pole[0] = "Pepa";
$pole[1] = "Honza";
$pole["jmenojana"] = "Jana"; 
$pole[] = "Karel";
echo "<!    HTML comment >";
/* 
* $pole2[0][0] = "Jouda";
* // $pole2[0][1] = "Hrouda";
* $pole2[1][0] = "10"; 
* $pole2[1][1] = "15";
* */
/*
operátory + - * / %-modulo
$prom3 = ++$prom2 = $promenna;
--$promenna;
 $promenna .= "ahoj";
 
*/
echo "<br>\n";
print_r($pole);
echo "<br>\n";
print_r($pole2); 
?>
<h1>Info</h1>
<?php
// phpinfo();

?>
<p>Příliš žluťoučký PHP</p>
<?php
echo "Ahoj <br>\n";
echo "Právě je: ";
?>
<h1>Nadpis</h1>
<?php
echo Date("G:i");
echo "<br>\n","další řádka<br>\n",Date("G:i"),"<br>\n";
echo "<br>\n"."\tdalší\\ \$ \"řádka\"<br>\r\n".Date("G:i");
?>


</body>
</html>




