<html>
<head></head>
<body>

<?php
$db_server='localhost';
$db_user='root';
$db_password='';
$db_name='textadventure';

$verbindung=mysql_connect($db_server,$db_user,$db_password);
if(!$verbindung)
    die("Server kann nicht erreicht werden!");
if(!mysql_select_db($db_name,$verbindung))
    die("Datenbank kann nicht angesprochen werden!");


$query="SELECT Idbefehle
        FROM befehle
        WHERE befehle = {$_GET['befehl']}";


$ergebnis=mysql_query($query,$verbindung);
if(!$ergebnis)
    echo mysql_error();

echo mysql_result($ergebnis,0);
?>
</body>
</html>
