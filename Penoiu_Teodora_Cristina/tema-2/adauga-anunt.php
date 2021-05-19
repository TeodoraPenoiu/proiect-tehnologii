<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noutati</title>

    <link rel="stylesheet" href="../tema-1/B/assets/css/home.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="../tema-1/B/assets/css/regulament.css">
    <link rel="stylesheet" href="../tema-1/B/assets/css/subiecte.css">
    <link rel="stylesheet" href="../tema-1/B/assets/css/noutati.css">

    <!-- Bootstrap core CSS -->
    <link href="assets/libs/bootstrap-5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/libs/bootstrap-5.0.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<header class="mb-auto">
    <div class="container">
        <a href="../tema-1/B/home.html"><img src="../tema-1/B/assets/img/logo.png" class="header-logo" alt="sigla concurs"></a>
        <nav class="nav nav-masthead float-md-end">
            <a class="nav-link" aria-current="page" href="../tema-1/B/home.html">Home</a>
            <a class="nav-link" href="../tema-1/B/regulament.html">Regulament</a>
            <a class="nav-link make-space" href="../tema-1/B/contact.html">Contact</a>
            <div class="pl-2 dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="../tema-1/B/sponsori.html">Sponsori</a></li>
                    <li><a class="dropdown-item" href="../tema-1/B/organizatori.html">Organizatori</a></li>
                    <li><a class="dropdown-item" href="participanti.php">Participanti</a></li>
                    <li><a class="dropdown-item" href="../tema-1/B/subiecte.html">Subiecte</a></li>
                    <li><a class="dropdown-item" href="rezultate.php">Rezultate</a></li>
                    <li><a class="dropdown-item" href="admin/login.php">Intra in cont</a></li>
                    <li><a class="dropdown-item" href="inscriere.php">Inscriete-te!</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<main>

<?php
require_once "inc/connect.php";

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

                $stmt = mysqli_prepare($conexiune,

                    "INSERT INTO anunturi(titlu, paragraf) VALUES (?, ?)");
                if (!mysqli_stmt_bind_param($stmt, "ss", $title, $paragraph)) {
                    die('Eroare legare parametri: ' . mysqli_stmt_error($stmt));
                }
                if (!mysqli_stmt_execute($stmt)) {
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

<?php
    /** Afisarea mesajelor din guestbook */
    $query = "SELECT id, titlu, paragraf FROM anunturi";
    $result = mysqli_query($conexiune, $query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $vtitlu = htmlspecialchars($row['titlu']);
            $vparagraf = htmlspecialchars($row['paragraf']);
            echo '<div class="noutate-container">';
            print("<a href='adauga-anunt.php?comanda=delete&id=". $row['id']."'>Delete</a>\n");
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
        <form action="" method="post">
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