<?php
    require_once "connect.php";
    include "header.php";
?>

<?php
    /* Definim si initializam cu sirul vid variabilele */
    $title = "";
    $paragraph = "";

    /* Presupunem ca nu avem erori de validare a parametrilor */
    $eroareTitlu = "";
    $eroareParagraf = "";

    $comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"] : NULL;
    if (isset($comanda)) {
        switch ($comanda) {
            case 'add':
                //Preluam parametri trimisi din forma de adaugare.
                $title = isset($_REQUEST["titlu"]) ? $_REQUEST["titlu"] : NULL;
                $paragraph = isset($_REQUEST["paragraf"]) ? $_REQUEST["paragraf"] : NULL;

                //Validam parametri primiti.
                $valid = true;
                if (empty($title)) {
                    $eroareTitlu = "Titlul nu poate fi vid!";
                    $valid = false;
                }
                if (empty($paragraph)) {
                    $eroareParagraf = "Mesajul nu poate fi vid!";
                    $valid = false;
                }
                if ($valid) {
                    //Construim fraza SQL pentru inserarea mesajului.
                    /*
                    $sql = sprintf(
                    "INSERT INTO mesaje(nume, email, data, mesaj) VALUES ('%s','%s', CURDATE(), '%s')",
                    mysqli_real_escape_string($id_conexiune, $nume),
                    mysqli_real_escape_string($id_conexiune, $email),
                    mysqli_real_escape_string($id_conexiune, $mesaj)
                    );
                    if (!mysqli_query($id_conexiune, $sql)) {
                    die('Error: ' . mysqli_error($id_conexiune));
                    }
                    */

                    $stmt=mysqli_prepare ($conexiune,

                        "INSERT INTO anunturi(titlu, paragraf) VALUES (?, ?)");
                    if (!mysqli_stmt_bind_param($stmt, "ss",$title, $paragraph)) {
                        die('Eroare legare parametri: ' . mysqli_stmt_error($stmt));
                    }
                    if (! mysqli_stmt_execute($stmt)) {
                        die('Eroare : ' . mysqli_stmt_error($stmt));
                    }
                    mysqli_stmt_close($stmt);
                    $title = $paragraph = "";
                    echo "<div class='succes container'>Paragraful a fost adaugat cu succes in baza de date.</div>";
                }
                break;

            case 'delete':
                $id = $_REQUEST["id"];
                if (!deleteMesaj($id)) {
                    echo "<div class='error container'>Stergere esuata.</div>";
                }
                break;
        }
    }
?>

<div class="container">
    <h1 class="page-title-noutati">Noutati</h1>
    <div class="noutate-container">
        <div>
            <img class="image-wrapper float-start" src="assets/img/exclamation-mark.jpg" alt="poza cu un semn al exclamarii">
        </div>
        <div class="float-md-end noutate-content">
            <h2 class="page-third-title mb-3 mt-0">Concurs de Informatica, editia 7 - data de inscriere</h2>
            <p>Data scadenta de inscriere la acest concurs este 20.06.2021. Pentru a te inscrie, mergi la<a href="inscriere.php">pagina de inscriere</a>, unde vei completa informatiile necesare.</p>
        </div>
        <div class="cleaner"></div>
    </div>
</div>

<?php
function deleteMesaj($id) {
    global $conexiune;
    if (is_numeric($id)) {
        $sql = sprintf("DELETE FROM anunturi WHERE id=%d", $id);
//echo "Query: $sql <br>";
        if (!mysqli_query($conexiune, $sql)) {
            die('Error: ' . mysqli_error($conexiune));
        }
        return TRUE;
    } else {
        return FALSE;
    }
}
?>

<?php
/** Afisarea mesajelor din guestbook */
$query = "SELECT id, titlu, paragraf FROM anunturi";
$result = mysqli_query($conexiune, $query);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $vtitlu = htmlspecialchars($row['titlu']);
        $vparagraf = htmlspecialchars($row['paragraf']);
        echo '<div class="noutate-container">';
        print("<a href='anunt.php?comanda=delete&id=". $row['id']."'>Delete</a>\n");
        print("<a href='edit.php?id=". $row['id']."'>Editeaza</a>\n");

        echo '<div><img class="image-wrapper float-start" src="assets/img/exclamation-mark.jpg" alt="poza cu un semn al exclamarii"></div>
<div class="float-md-end noutate-content"><h2 class="page-third-title mb-3 mt-0">';
        printf($vtitlu);
        echo '</h2><p>';
        printf($vparagraf);
        echo '</p></div><div class="cleaner"></div></div>';
    }
}
?>

<div class="container">
    <div class="mt-5">
        <h2>Lasa un mesaj</h2>
        <!-- Forma de adaugare mesaj-->
        <form action="anunt.php" method="post">
            <input name="comanda" type="hidden" value="add" />
            <p>Titlu:
                <input type="text" name="titlu" value="<?php echo htmlspecialchars($title); ?>" size="30">
                <span class="error"><?php echo $eroareTitlu; ?></span>
            </p>
            <p>Paragraf: <span class="error"><?php echo $eroareParagraf; ?></span><br />
                <textarea name="paragraf" rows="5" cols="60"><?php echo htmlspecialchars($paragraph); ?></textarea>
            </p>
            <input type="submit" value="Adauga" />
        </form>
    </div>
</div>

<?php
    include "footer.php";
?>
