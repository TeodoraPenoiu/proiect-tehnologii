<?php
include "header.php";
require_once "connect.php";
?>
<h1>Agenda</h1>
<?php
$comanda = isset($_REQUEST['comanda']) ? $_REQUEST['comanda'] : "";
if (!empty($comanda)) {
switch ($comanda){
case 'add':
    $nume = $_REQUEST["nume"];
    $numar = $_REQUEST["numar"];
//TODO: Aici trebuie adaugat cod ce valideaza datele.
    $sql="INSERT INTO contacte(nume, numar) VALUES ('$nume','$numar')";
    if (!mysqli_query($conexiune, $sql)) {
        die('Error: ' . mysqli_error($conexiune));
    }
    echo "<div class='succes'>Intrare adaugata cu succes</div>";
    break;
case 'delete':
    $id = $_REQUEST["id"];
//TODO: Aici trebuie adaugat cod ce valideaza datele.
    $sql = "DELETE FROM contacte WHERE id=$id";
    if (!mysqli_query($conexiune, $sql)) {
        die('Error: ' . mysqli_error($conexiune));
    }
    echo "<div class='succes'>Intrarea cu id-ul $id a fost stearsa cu succes</div>";
    break;
case 'edit':
$id = $_REQUEST["id"];
//TODO: Aici trebuie adaugat cod ce valideaza datele.
$sql = "SELECT * FROM contacte WHERE id=$id";
$result = mysqli_query($conexiune, $sql);
if ($row = mysqli_fetch_array($result)) {
$nume = $row['nume'];
$numar = $row['numar'];
?>
<!-- Forma de editare (begin) -->
<h3>Editare</h3>
<form action="index.php" method="post">
    <input name="comanda" type="hidden" value="update" />
    <input name="id" type="hidden" value="<?php echo $id;?>" />
    Nume: <input type="text" name="nume" value="<?php echo $nume;?>"/>
    Numar: <input type="text" name="numar" value="<?php echo $numar;?>"/>
    <input type="submit" value="Update"/>
</form>
    <!-- Forma de editare (end) -->
    <?php
} else {
    echo "<div class='error'>Intrarea cu id-ul $id nu exista!</div>";
}
    break;
    case 'update':
        $id = $_REQUEST["id"];
        $nume = $_REQUEST["nume"];
        $numar = $_REQUEST["numar"];
//TODO: Aici trebuie adaugat cod ce valideaza datele.
        $sql = "UPDATE contacte SET nume='$nume', numar='$numar' WHERE id=$id";
        if (!mysqli_query($conexiune, $sql)) {
            die('Error: ' . mysqli_error($conexiune));
//echo "<div class='error'>A aparut o eroare la actualizarea intrarii cu id-ul $id</div>";
        } else {
            echo "<div class='succes'>Intrarea cu id-ul $id a fost actualizata cu succes!</div>";
        }
        break;
}
}
?>
<?php
/** Afisarea numerelor din agenda */
$query = "SELECT * FROM contacte";
$result = mysqli_query($conexiune, $query);
if(mysqli_num_rows($result)) {
    print("<table border='1' cellspacing='0'>\n");
    print("<tr>\n");
    print("<th>#</th><th width='300'>Nume</th><th width='100'>Numar</th><th>Sterge</th>
<th>Edit</th>");
    print("</tr>\n");
    while($row = mysqli_fetch_array($result)){
        print("<tr>\n");
        print("<td>" . $row['id']. "</td>\n");
        print("<td>" . $row['nume']. "</td>\n");
        print("<td>" . $row['numar']. "</td>\n");
        print("<td><a href='index.php?comanda=delete&id=" . $row['id']. "'>Delete</a></td>\n");
        print("<td><a href='index.php?comanda=edit&id=" . $row['id']. "'>Edit</a></td>\n");
        print("</tr>\n");
    }
    print("</table>");
} else {
    print "Nu exista intrari in agenda!";
}
?>
<!-- Forma de adaugare -->
<form action="index.php" method="post">
    <input name="comanda" type="hidden" value="add" />
    Nume: <input type="text" name="nume" />
    Numar: <input type="text" name="numar" />
    <input type="submit" value="Adauga"/>
</form>
<?php
include "footer.php";
?>