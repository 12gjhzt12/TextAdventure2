<html>
<head><title>Textadventure</title>
    <link rel="stylesheet" href="design.css"/>
    <link rel="stylesheet" href="css/bootstrap.css"
</head>
<body>
<?php
require_once("models/config.php");
if(!isUserLoggedIn()) { header("Location: register.php"); die(); }

$db_server='localhost';
$db_user='root';
$db_password='';
$db_name='textadventure';

$verbindung=mysql_connect($db_server,$db_user,$db_password);
if(!$verbindung)
    die("Server kann nicht erreicht werden!");
if(!mysql_select_db($db_name,$verbindung))
    die("Datenbank kann nicht angesprochen werden!");

$query="SELECT display_name
FROM uc_users
Where id = {$loggedInUser->user_id}";
$ergebnis=mysql_query($query,$verbindung);
if(!$ergebnis)
    echo mysql_error();
if (mysql_num_rows($ergebnis) == 1)
{
    $row = mysql_fetch_array($ergebnis);
    $username = $row[0];
}

?>
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Main.php">Textadventure</a>
            </div>
            <div class="colla navbar-collapse" id="">
                <ul class="nav navbar-nav">
                    <li><a href="main.php">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Angemeldet als <?php echo "$username"; ?></p>
                    <li><a href="logout.php">Log Out</a></li>
                    <li><a href="user_settings.php">Einstellungen</a></li>
                </ul>

            </div>
        </div>
    </nav>
<div class="panel panel-default">
    <div class="panel-heading">Text</div>
    <div class="panel-body">
        <div> <!-- php -->
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
$tmp = $loggedInUser->user_id;



$query=
"SELECT texte.Texte, storybefehle.IdTexte1
FROM befehle JOIN storybefehle
ON befehle.IdBefehle = storybefehle.IdBefehle
JOIN texte
ON storybefehle.IdTexte1 = texte.IdTexte
WHERE Befehle = '{$_GET['befehl']}'  AND storybefehle.IdTexte = '{$_GET['fortschritt']}'
";
$ergebnis=mysql_query($query,$verbindung);
if(!$ergebnis)
    echo mysql_error();


$update_query=
"UPDATE uc_users
SET spielstand = {$_GET['fortschritt']}
WHERE id = {$tmp}";

$update_ergebnis=mysql_query($update_query,$verbindung);
if(!$update_ergebnis)
    echo mysql_error();

$update_query2=
"UPDATE uc_users
SET spielstandBefehle =
(SELECT IdBefehle
FROM befehle
WHERE Befehle = '{$_GET['befehl']}')
WHERE id = {$tmp}";

$update_ergebnis2=mysql_query($update_query2,$verbindung);
if(!$update_ergebnis2)
    echo mysql_error();

if (mysql_num_rows($ergebnis) == 1)
{
    $row = mysql_fetch_array($ergebnis);
    echo $row[0];
    $fortschritt = $row[1];
}
?></div>
    </div>
</div><!-- Ausgabe -->
<div class="row">
    <form action="./eingabe.php" method="get">
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" name="befehl" size="10">
            <span class="input-group-btn">
                <button class="btn btn-default" value="Ausf&uuml;hren" type="submit">Ausf&uuml;hren!</button>
            </span>
            <input type="hidden" name="fortschritt" value="<?=$fortschritt?>"/>

        </div>
    </div>
    </form>
</div><!-- Eingabe -->
</div>
</body>
</html>