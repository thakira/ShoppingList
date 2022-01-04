<?php
//Einbinden der Klassen sowie der Datenbankparameter
include("./includes/config.inc.php");
include("./classes/DBConnect.php");
include("./classes/ShoppingList.php");

//Erstellen eines Connection-Objektes auf die Datenbank
$conn = new DBConnect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_DBNAME, $DB_PORT);

//Variable zum Auffangen von Fehlermeldungen
$message = "";

/*Inhalte des POST-Arrays nach Submit auffangen, auf Vollständigkeit überprüfen
und neues Objekt in die Datenbank schreiben*/
if (isset($_POST) && !empty($_POST)) {
    if (empty($_POST["menge"])) {
        $message .= "<pre>      Bitte eine Menge eingeben</pre>";
    }
    if (empty($_POST["ware"])) {
        $message .= "<pre>      Bitte eine Ware eingeben</pre>";
    } elseif ((!empty($_POST))) {
        $conn->addProduct($_POST["ware"], $_POST["menge"]);
    }
}

//GET-Array nach Klick auf "löschen" auswerten und über Methode löschen
if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
    $conn->removeProduct($_GET["delete"]);
}
//GET-Array nach Klick auf die Checkbox auswerten und über Methode switchen
if (isset($_GET["check"])) {
    $conn->checkProduct($_GET['mark'], $_GET['check']);
}

//Datenbankinhalt über Connection-Objekt einlesen
$result = $conn->readDB();

/* neue Shopplingliste erzeugen und mit dem
Datenbankinhalt zur Weiterverarbeitung übergeben*/
$list = new ShoppingList();
$list->getList($result);

//Fehlervariable auslesen und ausgeben
if (isset ($message) && !empty($message)) {
    echo $message;
}

//Datenbankverbindung schließen
if ($conn) {
    $conn->close();
}
?>