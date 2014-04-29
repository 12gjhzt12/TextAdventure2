<html>
<head>
<title>Textadventure</title>
    <link rel="stylesheet" href="design.css"/>
    <link rel="stylesheet" href="css/bootstrap.css"
</head>
<body>
<div class="container">
<div><?php
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

$tmp = $loggedInUser->user_id;
$query="SELECT spielstand
FROM uc_users
WHERE id = {$tmp}";
$ergebnis=mysql_query($query,$verbindung);
if(!$ergebnis)
    echo mysql_error();
    if (mysql_num_rows($ergebnis) == 1)
{
    $row = mysql_fetch_array($ergebnis);
    $fortschritt = $row[0];
}


$query="SELECT Befehle
FROM befehle
WHERE IdBefehle = (SELECT spielstandBefehle
FROM uc_users
WHERE id = {$tmp})";
$ergebnis=mysql_query($query,$verbindung);
if(!$ergebnis)
    echo mysql_error();
if (mysql_num_rows($ergebnis) == 1)
{
    $row = mysql_fetch_array($ergebnis);
    $befehl = $row[0];
}
if($fortschritt == '')
{
    $fortschritt = 13;
    $befehl = "weiter";
}


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
</div><!-- Php -->
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
                <li><a href="./Eingabe.php?befehl=<?=$befehl?>&fortschritt=<?=$fortschritt?>" >Zum Spiel</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text">Angemeldet als <?php echo "$username"; ?></p>
                <li><a href="logout.php">Log Out</a></li>
                <li><a href="user_settings.php">Einstellungen</a></li>
            </ul>

        </div>
    </div>
</nav>
<div class="page-header">
    <h1>Textadventure <small>Die Textadventure Seite Nr.1</small></h1>
</div>

<a href="./Eingabe.php?befehl=<?=$befehl?>&fortschritt=<?=$fortschritt?>" class="btn btn-default">Zum Spiel</a>
</div>
</body>
</html>