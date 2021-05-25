<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noutati</title>

    <link rel="stylesheet" href="../../tema-1/B/assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../../tema-1/B/assets/css/regulament.css">
    <link rel="stylesheet" href="../../tema-1/B/assets/css/subiecte.css">
    <link rel="stylesheet" href="../../tema-1/B/assets/css/noutati.css">

    <!-- Bootstrap core CSS -->
    <link href="../assets/libs/bootstrap-5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/libs/bootstrap-5.0.0/js/bootstrap.bundle.min.js"></script>

    <style>
        table, th, td {
            border: 0.5px solid;
            border-collapse: collapse!important;
            border-spacing: 0;
        }
    </style>

    <script src="../validare.js" type="text/javascript"></script>

</head>

<body>

<main>
<?php
session_start();
require_once "../inc/configuration.php";
include "../inc/connect.php";
include "admin-functions.php";
?>

<?php
//pentru anunturi
/* Definim si initializam cu sirul vid variabilele */
$title = "";
$paragraph = "";

/* Presupunem ca nu avem erori de validare a parametrilor */
$eroareTitlu = "";
$eroareParagraf = "";

$comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"] : NULL;
if (isset($comanda)) {
    switch ($comanda) {
        case 'add-anunturi':
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
                echo "<div class='succes container align-text-center'>Paragraful a fost adaugat cu succes in baza de date.</div>";
            }
            break;

        case 'delete-from-anunturi':
            $id = $_REQUEST["id"];
            if (!deleteMesaj($id)) {
                echo "<div class='error container'>Stergere esuata.</div>";
            }
            break;

        case 'edit-anunturi':
            $id = $_GET["id"];
            $qry = mysqli_query($conexiune, "select * from anunturi where id='$id'"); // select query

            $data = mysqli_fetch_array($qry); // fetch data

            if (isset($_POST['update'])) // when click on Update button
            {
                $id = $_GET["id"];
                $qry = mysqli_query($conexiune, "select * from anunturi where id='$id'"); // select query
                $data = mysqli_fetch_array($qry); // fetch data
                if (isset($_POST['update'])) // when click on Update button
                {
                    $titlu = $_POST['titlu'];
                    $paragraf = $_POST['paragraf'];
                    $edit = mysqli_query($conexiune, "update anunturi set titlu='$titlu', paragraf='$paragraf' where id='$id'");
                    if($edit)
                    {
                        mysqli_close($conexiune); // Close connection
                        header("location:index.php"); // redirects to all records page
                        exit;
                    }
                    else
                    {
                        echo "Problem updating.";
                    }
                }
            }
    }
}
?>

<?php
    //functia asta sterge anunturi
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
    $nume = "";
    $prenume = "";
    $sub_1 = "";
    $sub_2 = "";
    $sub_3 = "";
    $general = "";

    /* Presupunem ca nu avem erori de validare a parametrilor */
    $eroareNume = "";
    $eroarePrenume = "";
    $eroareSub1 = "";
    $eroareSub2 = "";
    $eroareSub3 = "";
    $eroareGeneral = "";

    $nume1 = "";
    $prenume1 = "";
    $sub_1_1 = "";
    $sub_2_1 = "";
    $sub_3_1 = "";
    $general1 = "";

    $comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"] : NULL;
    if (isset($comanda)) {
        switch ($comanda) {
            case 'add-rezultate':
                //Preluam parametri trimisi din forma de adaugare.
                $nume = isset($_REQUEST["nume"]) ? $_REQUEST["nume"] : NULL;
                $prenume = isset($_REQUEST["prenume"]) ? $_REQUEST["prenume"] : NULL;
                $sub_1 = isset($_REQUEST["sub_1"]) ? $_REQUEST["sub_1"] : NULL;
                $sub_2 = isset($_REQUEST["sub_2"]) ? $_REQUEST["sub_2"] : NULL;
                $sub_3 = isset($_REQUEST["sub_3"]) ? $_REQUEST["sub_3"] : NULL;
                $general = ((int)$sub_1 + (int)$sub_2 + (int)$sub_3)/3;

                //Validam parametri primiti.
                $valid = true;
                if (empty($nume)) {
                    $eroareNume = "Numele nu poate fi vid!";
                    $valid = false;
                }
                if (empty($prenume)) {
                    $eroarePrenume = "Prenumele nu poate fi vid!";
                    $valid = false;
                }
                if (empty($sub_1)) {
                    $eroareSub1 = "Nota la subiectul 1 nu poate fi vida!";
                    $valid = false;
                }
                if (empty($sub_2)) {
                    $eroareSub2 = "Nota la subiectul 2 nu poate fi vida!";
                    $valid = false;
                }
                if (empty($sub_3)) {
                    $eroareSub3 = "Nota la subiectul 3 nu poate fi vida!";
                    $valid = false;
                }
                if (empty($general)) {
                    $eroareGeneral = "Prenumele nu poate fi vid!";
                    $valid = false;
                }
                if ($valid) {

                    $stmt=mysqli_prepare ($conexiune,
                        "INSERT INTO rezultate(nume, prenume, sub_1, sub_2, sub_3, general) VALUES (?, ?, ?, ?, ?, ?)");
                    if (!mysqli_stmt_bind_param($stmt, "ssssss",$nume, $prenume, $sub_1, $sub_2, $sub_3, $general)) {
                        die('Eroare legare parametri: ' . mysqli_stmt_error($stmt));
                    }
                    if (! mysqli_stmt_execute($stmt)) {
                        die('Eroare : ' . mysqli_stmt_error($stmt));
                    }
                    mysqli_stmt_close($stmt);
                    $nume = $prenume = $sub_1 = $sub_2 = $sub_3 = $general = "";
                }
                else{
                    echo "<div class='succes container'>Problema la adaugarea rezultatului in baza de date.</div>";
                }
                break;

            case 'delete-rezultate':
                $id = $_REQUEST["id"];
                if (!deleteRezultat($id)) {
                    echo "<div class='error container'>Stergere esuata.</div>";
                }
                break;

            case 'edit-rezultate':
                $id = $_GET["id"];
                $qry = mysqli_query($conexiune, "select * from rezultate where id='$id'"); // select query
                $data = mysqli_fetch_array($qry); // fetch data
                if (isset($_POST['update'])) // when click on Update button
                {
                    $nume1 = $_POST['nume'];
                    $prenume1 = $_POST['prenume'];
                    $sub_1_1 = $_POST['sub_1'];
                    $sub_2_1 = $_POST['sub_2'];
                    $sub_3_1 = $_POST['sub_3'];
                    $zece = 10;
                    $edit = mysqli_query($conexiune, "update rezultate set nume='$nume1', prenume='$prenume1',
                     sub_1 = $sub_1_1, sub_2 = $sub_2_1, sub_3 = $sub_3_1, general = ($sub_1_1 + $sub_2_1 + $sub_3_1)/3 where id='$id'");
                    if($edit)
                    {
                        mysqli_close($conexiune); // Close connection
                        header("location:index.php"); // redirects to all records page
                        exit;
                    }
                    else
                    {
                        echo "Problem updating.";
                    }
                }
        }
    }
    ?>

    <?php
    //functia asta sterge rezultate
    function deleteRezultat($id) {
        global $conexiune;
        if (is_numeric($id)) {
            $sql = sprintf("DELETE FROM rezultate WHERE id=%d", $id);
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
        $comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"] : NULL;
        if (isset($comanda)) {
            switch ($comanda) {
                case 'login':
                    $username = $_REQUEST["username"];
                    $password =  $_REQUEST["password"];
                    //TODO: validare parametrii
                    if (!doLogin($username, $password)) {
                        echo "<div class='error align-text-center'>Autentificare esuata!</div>";
                    }
                    break;

                case 'logout':
                    doLogout();
                    break;
            }
        }

        if (!isLogged()) {
            print("<header class='mb-auto'>");
            print("<div class='container'>");
            print("<a href='../../tema-1/B/home.html'><img src='../../tema-1/B/assets/img/logo.png' class='header-logo' alt='sigla concurs'></a>");
            print("</div></header>");
            include "login.php";
        } else {
            print("<header class='mb-auto'>");
            print("<div class='container'>");
            print("<img src='../../tema-1/B/assets/img/logo.png' class='header-logo' alt='sigla concurs'>");
            print("</div></header>");
            print("<div class='container'>");
            print("<a class='nav-link align-text-center page-title' data-bs-toggle='collapse' href='#anunturi' aria-expanded='false'><h1>Anunturi</h1>");
            print("<div class='collapse' id='anunturi'>");
            /** Afisarea anunturilor */
            $query = "SELECT id, titlu, paragraf FROM anunturi";
            $result = mysqli_query($conexiune, $query);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
                    $vtitlu = htmlspecialchars($row['titlu']);
                    $vparagraf = htmlspecialchars($row['paragraf']);
                    echo '<div class="noutate-container">';
                    print("<a href='index.php?comanda=delete-from-anunturi&id=". $row['id']."'>Delete</a>\n");
                    print("<a href='index.php?comanda=edit-anunturi&id=". $row['id']."'>Editeaza</a>\n");
                    echo '<div><img class="image-wrapper float-start" src="../assets/img/exclamation-mark.jpg" alt="poza cu un semn al exclamarii"></div>
        <div class="float-md-end noutate-content"><h2 class="page-third-title mb-3 mt-0">';
                    printf($vtitlu);
                    echo '</h2><p>';
                    printf($vparagraf);
                    echo '</p></div><div class="cleaner"></div></div>';
                }
            }
            print("<div class='container'>");
            print("<div class='float-start'>");
            print("<a class='nav-link' data-bs-toggle='collapse' href='#adauga-anunturi' aria-expanded='false'><h2>Adauga un anunt</h2></a>");
            print("<form name='adauga_anunt' class='collapse error' action='' method='post' id='adauga-anunturi'>");
            print("<input name='comanda' type='hidden' value='add-anunturi'>");
            print("<p>Titlu:");
            print("<input type='text' name='titlu' onkeyup='validationText(this)' id='titlu-anunt' value='");
            print(htmlspecialchars($title));
            print("' size='30'>");
            print("<span class='error'><?php echo $eroareTitlu; ?></span>");
            print("</p>");
            print("<p>Paragraf: <span class='error'><?php echo $eroareParagraf; ?></span><br />");
            print("<textarea name='paragraf' rows='5' cols='60' onkeyup='validationContinut(this)' id='continut'>");
            print(htmlspecialchars($paragraph));
            print("</textarea>");
            print("</p>");
            print("<input type='submit' value='Adauga'>");
            print("</form>");
            print("</div>");
            print("<div class='float-md-end'>");
            print("<a class='nav-link' data-bs-toggle='collapse' href='#update-anunturi' aria-expanded='false'><h2>Update Data</h2></a>");
            print("<form class='collapse' action='' method='POST' id='update-anunturi'>");
            print("<p>Titlu:<br>");
            print("<input type='text' onkeyup='validationTitlu(this)' name='titlu' value='");
            print($data['titlu']);
            print("'>");
            print("</p>");
            print("<p>Continut:<br>");
            print("<input type='text' onkeyup='validationContinut(this)' name='paragraf' value='");
            print($data['paragraf']);
            print("'>");
            print("</p>");
            print("<input type='submit' name='update' value='Update'>");
            print("</form>");
            print("</div>");
            print("<div class='cleaner'></div>");
            print("</div>");
            print("</div>");

            print("<a class='nav-link align-text-center page-title' data-bs-toggle='collapse' href='#rezultate' aria-expanded='false'><h1>Rezultate</h1></a>");
            print("<div class='container collapse' id='rezultate'>");

            /** Afisarea rezultatelor */
            $query = "SELECT * FROM rezultate";
            $result = mysqli_query($conexiune, $query);
            if(mysqli_num_rows($result)) {
                echo '<div></div>';
                echo '<table class="page-table align-middle"><tr><th class="table-space">Nume</th><th class="table-space">Prenume</th>
    <th class="table-space">Punctaj subiectul I</th><th class="table-space">Punctaj subiectul II</th><th class="table-space">Punctaj subiectul III</th>
    <th class="table-space align-text-center">Punctaj general <br> (calculat automat)</th></tr>';
                while($row = mysqli_fetch_array($result)){
                    echo '<tr><td class="table-space">';
                    print($row['nume']);
                    echo '</td><td class="table-space">';
                    print($row['prenume']);
                    echo '</td><td class="table-space">';
                    print($row['sub_1']);
                    echo '</td><td class="table-space">';
                    printf($row['sub_2']);
                    echo '</td><td class="table-space">';
                    print($row['sub_3']);
                    echo '</td><td class="table-space">';
                    print($row['general']);
                    echo '</td><td class="table-space">';
                    print("<a href='index.php?comanda=delete-rezultate&id=". $row['id']."'>Delete</a>\n");
                    echo '</td><td class="table-space">';
                    print("<a href='index.php?comanda=edit-rezultate&id=". $row['id']."'>Editeaza</a>\n");
                    echo '</td></tr>';
                }
                echo '</table>';
            } else {
                print "Nu exista intrari in agenda!";
            }

            print("<div class='container'>");
            print("<div class='float-start'>");
            print("<a class='nav-link' data-bs-toggle='collapse' href='#add-data' aria-expanded='false'><h3>Add Data</h3></a>");
            print("<form class='collapse' action='' method='post' id='add-data'>");
            print("<input name='comanda' type='hidden' value='add-rezultate'>");
            print("<p>Nume:<br>");
            print("<input type='text' name='nume' onkeyup='validationText(this)' value='");
            print(htmlspecialchars($nume));
            print("' size='30'>");
            print("<span class='error'>");
            print($eroareNume);
            print("</span>");
            print("</p>");
            print("<p>Prenume:<br>");
            print("<input type='text' name='prenume' onkeyup='validationText(this)' value='");
            print(htmlspecialchars($prenume));
            print("' size='30'>");
            print("<span class='error'>");
            print($eroarePrenume);
            print("</span>");
            print("</p>");
            print("<p>Nota la subiectul I:<br>");
            print("<input type='text' name='sub_1' onkeyup='validationNota(this)' value='");
            print(htmlspecialchars($sub_1));
            print("' size='30'>");
            print("<span class='error'>");
            print($eroareSub1);
            print("</span>");
            print("</p>");
            print("<p>Nota la subiectul II:<br>");
            print("<input type='text' name='sub_2' onkeyup='validationNota(this)' value='");
            print(htmlspecialchars($sub_2));
            print("' size='30'>");
            print("<span class='error'><?php echo $eroareSub2; ?></span>");
            print("</p>");
            print("<p>Nota la subiectul III:<br>");
            print("<input type='text' name='sub_3' onkeyup='validationNota(this)' value='");
            print(htmlspecialchars($sub_3));
            print("' size='30'>");
            print("<span class='error'>");
            print($eroareSub3);
            print("</span>");
            print("</p>");
            print("<input type='submit' value='Adauga'>");
            print("</form>");
            print("</div>");
            print("<div class='float-md-end'>");
            print("<a class='nav-link' data-bs-toggle='collapse' href='#update-data' aria-expanded='false'><h3>Update Data</h3></a>");
            print("<form class='collapse' action='' method='POST' id='update-data'>");
            print("<p>Nume:<br>");
            print("<input type='text' onkeyup='validationText(this)' name='nume' value='");
            print($data['nume']);
            print("' placeholder='...' size='30'>");
            print("</p>Prenume:<br>");
            print("<input type='text' onkeyup='validationContinut(this)' name='prenume' value='");
            print($data['prenume']);
            print("' placeholder='...' size='30'>");
            print("</p>Nota la subiectul I:<br>");
            print("<input type='text' onkeyup='validationNota(this)' name='sub_1' value='");
            print($data['sub_1']);
            print("' placeholder='...' size='30'>");
            print("</p>Nota la subiectul II:<br>");
            print("<input type='text' onkeyup='validationNota(this)' name='sub_2' value='");
            print($data['sub_2']);
            print("' placeholder='...' size='30'>");
            print("</p>Nota la subiectul III:<br>");
            print("<input type='text' onkeyup='validationNota(this)' name='sub_3' value='");
            print($data['sub_3']);
            print("' placeholder='...' size='30'>");
            print("<input type='submit' name='update' value='Update'>");
            print("</form>");
            print("</div>");
            print("</div>");
            print("</div>");
            print("<div class='cleaner'></div>");

            printf('<a href="index.php?comanda=logout" class="page-title float-md-end">Logout</a>', getLoggedUser());
            print("</div>");
        }
        ?>

        <?php

include "../inc/footer.php";

?>
