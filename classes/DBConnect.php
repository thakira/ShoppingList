<?php
//Klasse zum Erzeugen eines Datenbankverbindunggsobjektes und Datenbankoperationen
class DBConnect
{

    private $conn = "";

    //Konstruktor zum Erzeugen des Verbindungsobjektes
    function __construct($DB_HOST, $DB_USER, $DB_PASSWD, $DB_DBNAME, $DB_PORT)
    {
        $this->conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_DBNAME, $DB_PORT);
        if (!$this->conn) {
            echo "Keine DB Verbindung!";
            echo "Debugging errno: " . mysqli_connect_errno() . "\n";
            echo "Debugging error: " . mysqli_connect_error() . "\n";
            exit;
        }
    }

    //Datenbankinhalt auslesen und zurückgeben
    function readDB()
    {
        $sql = "select * from einkaufsliste";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    //Datensatz mit Hilfe der übergebenen id aus der Datenbank löschen
    function removeProduct($id)
    {
        $sqlDelete = "DELETE FROM einkaufsliste WHERE id = $id";
        if (!mysqli_query($this->conn, $sqlDelete)) {
            echo "Error deleting record: " . mysqli_error(dbconnect::$conn);
        }
    }

    //markiert-Spalte innerhalb der Datenbank mit Hilfe übergebener ID switchen
    function checkProduct($markiert, $id)
    {
        if ($markiert == 1) {
            $sql = "update einkaufsliste set markiert = 0 where id = $id";
            $resultUpdate = mysqli_query($this->conn, $sql);
        } else {
            $sql = "update einkaufsliste set markiert = 1 where id = $id";
            $resultUpdate = mysqli_query($this->conn, $sql);
        }
    }

    //Neuen Listeneintrag in die Datenbank schreiben
    function addProduct($name, $menge)
    {
        $sqlInsert = "INSERT INTO einkaufsliste (name, menge, markiert) VALUES (\"$name\", $menge, 0)";
        $resultInsert = mysqli_query($this->conn, $sqlInsert);
    }

    //Datenbankverbindung schließen
    function close()
    {
        $this->conn->close();
    }
}
?>


