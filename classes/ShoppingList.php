<?php
class ShoppingList
{
// Erstellen der Listenausgabe
function getList($result)
{
?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ISP - Einsendeaufgabe 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
</head>
<body>
<header>
    <h2>EA3 - Einkaufsliste</h2>
</header>
<main>
    <ul id="todolist">
        <?php
        //Datenbankinhalt Zeile für Zeile auswerten und gemäß Inhalten anzeigen
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            ?>
            <li>
                <!-- Inhalt der Spalten markiert und jeweilige ID zur Weiterverarbeitung in die GET-Variable schreiben
                Bei Klick auf die Checkbox, CSS-Klasse gemäß des aktuellen Inhalts in der markiert-Spalte ändern
                (1 = abgehakt = class = checked, 0 = nicht abgehakt = class=done-->
                <a href=index.php?mark=<?php echo($row['markiert'])?>&check=<?php echo($id)?> class="done
            <?php if ($row['markiert']) echo 'checked'; ?>"  title=Ware als eingekauft markieren ></a>
                <?php
                echo "<span>{$row['menge']}</span>
                        <span>{$row['name']}</span>
                        <!-- Bei Klick auf löschen, die ID des Datensatzes zur Weiterverarbeitung in die GET-Variable schreiben -->
            <a href=?delete={$row["id"]} class=\"delete\" title=\"Ware aus Liste löschen\">löschen</a>";
                ?>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="spacer"></div>
    <!-- Inhalt der Inputfelder name und menge nach Klick auf den Absenden-Button in der POST-Variable speichern zur Weiterverarbeitung -->
    <form id="add-todo" method="POST" action="index.php">
        <input type="text" placeholder="Menge" name="menge">
        <input type="text" placeholder="Text für neue Ware" name="ware">
        <input type="submit" value="hinzufügen">
    </form>

</main>
<footer>
    <p>Kauth, Verena - HS Emden-Leer</p>
</footer>
</body>
</html>"
<?php
}
}
