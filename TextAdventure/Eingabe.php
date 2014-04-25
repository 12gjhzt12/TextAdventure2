<html>
<body>
<?php

$db_server='localhost';
$db_user='root';
$db_password='';
$db_name='textadventure';



//Verbindung
$verbindung=mysql_connect($db_server,$db_user,$db_password);
if(!$verbindung)
    die("Server kann nicht erreicht werden!");
if(!mysql_select_db($db_name,$verbindung))
    die("Datenbank kann nicht angesprochen werden!");

//query
$query="SELECT texte
        FROM texte
        ";
$ergebnis=mysql_query($query,$verbindung);
if(!$ergebnis)
    echo mysql_error();


//ausgabe
echo mysql_result($ergebnis, 0);

?>
<form action="./auswertung.php" method="get">
    Eingabe:
    <input type="text" name="befehl" size="10">
    <input type="submit" value="Ausf&uuml;hren">
</form>
</body>
</html>