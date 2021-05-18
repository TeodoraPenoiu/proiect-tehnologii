<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista cu rezultatele</title>

    <link rel="stylesheet" href="../tema-1/B/assets/css/home.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="../tema-1/B/assets/css/regulament.css">
    <link rel="stylesheet" href="../tema-1/B/assets/css/subiecte.css">
    <link rel="stylesheet" href="../tema-1/B/assets/css/noutati.css">

    <!-- Bootstrap core CSS -->
    <link href="assets/libs/bootstrap-5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/libs/bootstrap-5.0.0/js/bootstrap.bundle.min.js"></script>

    <style>
        table, th, td {
            border: 0.5px solid;
            border-collapse: collapse!important;
            border-spacing: 0;
        }
    </style>
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
                    <li><a class="dropdown-item" href="anunt.php">Noutati</a></li>
                    <li><a class="dropdown-item" href="participanti.php">Participanti</a></li>
                    <li><a class="dropdown-item" href="../tema-1/B/subiecte.html">Subiecte</a></li>
                    <li><a class="dropdown-item" href="rezultate.php">Rezultate</a></li>
                    <li><a class="dropdown-item" href="login.php">Intra in cont</a></li>
                    <li><a class="dropdown-item" href="inscriere.php">Inscriete-te!</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<main>

    <h1 class="page-title">Rezultate</h1>

<?php
    require_once "connect.php";
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
            case 'add':
                //Preluam parametri trimisi din forma de adaugare.
                $nume = isset($_REQUEST["nume"]) ? $_REQUEST["nume"] : NULL;
                $prenume = isset($_REQUEST["prenume"]) ? $_REQUEST["prenume"] : NULL;
                $sub_1 = isset($_REQUEST["sub_1"]) ? $_REQUEST["sub_1"] : NULL;
                $sub_2 = isset($_REQUEST["sub_2"]) ? $_REQUEST["sub_2"] : NULL;
                $sub_3 = isset($_REQUEST["sub_3"]) ? $_REQUEST["sub_3"] : NULL;
                $general = $sub_1 + $sub_2 + $sub_3;

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

            case 'delete':
                $id = $_REQUEST["id"];
                if (!deleteMesaj($id)) {
                    echo "<div class='error container'>Stergere esuata.</div>";
                }
                break;

            case 'edit':
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

                    $edit = mysqli_query($conexiune, "update rezultate set nume='$nume1', prenume='$prenume1',
                     sub_1 = $sub_1_1, sub_2 = $sub_2_1, sub_3 = $sub_3_1, general = $sub_1_1 + $sub_2_1 + $sub_3_1 where id='$id'");

                    if($edit)
                    {
                        mysqli_close($conexiune); // Close connection
                        header("location:rezultate.php"); // redirects to all records page
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

<div class="container">
<?php
    /** Afisarea numerelor din agenda */
    $query = "SELECT * FROM rezultate";
    $result = mysqli_query($conexiune, $query);
    if(mysqli_num_rows($result)) {
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
            print("<a href='rezultate.php?comanda=delete&id=". $row['id']."'>Delete</a>\n");
            echo '</td><td class="table-space">';
            print("<a href='rezultate.php?comanda=edit&id=". $row['id']."'>Editeaza</a>\n");
            echo '</td></tr>';
        }
        echo '</table>';
    } else {
        print "Nu exista intrari in agenda!";
    }
    ?>
    </div>

    <?php
    function deleteMesaj($id) {
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

    <div class="container">
        <div class="float-start">
            <a class="nav-link" data-bs-toggle="collapse" href="#add-data" aria-expanded="false"><h3>Add Data</h3></a>
            <form class="collapse" action="rezultate.php" method="post" id="add-data">
                <input name="comanda" type="hidden" value="add" />
                <p>Nume:<br>
                    <input type="text" name="nume" value="<?php echo htmlspecialchars($nume); ?>" size="30">
                    <span class="error"><?php echo $eroareNume; ?></span>
                </p>
                <p>Prenume:<br>
                    <input type="text" name="prenume" value="<?php echo htmlspecialchars($prenume); ?>" size="30">
                    <span class="error"><?php echo $eroarePrenume; ?></span>
                </p>
                <p>Nota la subiectul I:<br>
                    <input type="text" name="sub_1" value="<?php echo htmlspecialchars($sub_1); ?>" size="30">
                    <span class="error"><?php echo $eroareSub1; ?></span>
                </p>
                <p>Nota la subiectul II:<br>
                    <input type="text" name="sub_2" value="<?php echo htmlspecialchars($sub_2); ?>" size="30">
                    <span class="error"><?php echo $eroareSub2; ?></span>
                </p>
                <p>Nota la subiectul III:<br>
                    <input type="text" name="sub_3" value="<?php echo htmlspecialchars($sub_3); ?>" size="30">
                    <span class="error"><?php echo $eroareSub3; ?></span>
                </p>
                <input type="submit" value="Adauga" />
            </form>
        </div>
        <div class="float-md-end">
            <a class="nav-link" data-bs-toggle="collapse" href="#update-data" aria-expanded="false"><h3>Update Data</h3></a>
            <form class="collapse" action="" method="POST" id="update-data">
                <p>Nume:<br>
                    <?php if(!empty($data)) { ?>
                        <input type="text" name="nume" value="<?php echo $data['nume']; ?>" placeholder="..." size="30">
                    <?php } ?>
                </p>Prenume:<br>
                    <?php if(!empty($data)) { ?>
                        <input type="text" name="prenume" value="<?php echo $data['prenume']; ?>" placeholder="..." size="30">
                    <?php } ?>
                </p>Nota la subiectul I:<br>
                    <?php if(!empty($data)) { ?>
                        <input type="text" name="sub_1" value="<?php echo $data['sub_1']; ?>" placeholder="..." size="30">
                    <?php } ?>
                </p>Nota la subiectul II:<br>
                    <?php if(!empty($data)) { ?>
                        <input type="text" name="sub_2" value="<?php echo $data['sub_2']; ?>" placeholder="..." size="30">
                    <?php } ?>
                </p>Nota la subiectul III:<br>
                    <?php if(!empty($data)) { ?>
                        <input type="text" name="sub_3" value="<?php echo $data['sub_3']; ?>" placeholder="..." size="30">
                    <?php } ?>
                <input type="submit" name="update" value="Update">
            </form>
        </div>
    </div>

<?php
    include "footer.php";
?>
