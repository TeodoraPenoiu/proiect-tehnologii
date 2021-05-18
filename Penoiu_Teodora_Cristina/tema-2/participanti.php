<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista cu participanti</title>

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

<?php
    require_once "connect.php";
?>

<div class="container">
    <div class="box-shadow mb-3">
    <h1 class="page-title">Elevii din clasele 5-6 inscrisi la concurs:</h1>
    <div class="box-shadow mb-3">
    <?php
    /** Afisarea numerelor din agenda */
    $query = "SELECT * FROM clasele5_6";
    $result = mysqli_query($conexiune, $query);
    if(mysqli_num_rows($result)) {
        print("<table>\n");
        print("<tr>\n");
        print("<th>Nume</th><th>Prenume</th><th>Clasa</th>");
        print("</tr>\n");
        while($row = mysqli_fetch_array($result)){
            print("<tr>\n");
            print("<td>" . $row['nume']. "</td>\n");
            print("<td>" . $row['prenume']. "</td>\n");
            print("<td>" . $row['clasa']. "</td>\n");
            print("</tr>\n");
        }
        print("</table>");
    } else {
        print "Nu exista intrari in agenda!";
    }
    ?>
    </div>
    </div>

    <div class="box-shadow mb-3">
    <h1 class="page-title">Elevii din clasele 7-8 inscrisi la concurs:</h1>
    <div class="box-shadow mb-3">
    <?php
    /** Afisarea numerelor din agenda */
    $query = "SELECT * FROM clasele7_8";
    $result = mysqli_query($conexiune, $query);
    if(mysqli_num_rows($result)) {
        print("<table>\n");
        print("<tr>\n");
        print("<th>Nume</th><th>Prenume</th><th>Clasa</th>");
        print("</tr>\n");
        while($row = mysqli_fetch_array($result)){
            print("<tr>\n");
            print("<td>" . $row['nume']. "</td>\n");
            print("<td>" . $row['prenume']. "</td>\n");
            print("<td>" . $row['clasa']. "</td>\n");
            print("</tr>\n");
        }
        print("</table>");
    } else {
        print "Nu exista intrari in agenda!";
    }
    ?>
    </div>
    </div>

    <div class="box-shadow mb-3">
    <h1 class="page-title">Elevii din clasele 9-10 inscrisi la concurs:</h1>
    <div class="box-shadow mb-3">
    <?php
    /** Afisarea numerelor din agenda */
    $query = "SELECT * FROM clasele9_10";
    $result = mysqli_query($conexiune, $query);
    if(mysqli_num_rows($result)) {
        print("<table>\n");
        print("<tr>\n");
        print("<th>Nume</th><th>Prenume</th><th>Clasa</th>");
        print("</tr>\n");
        while($row = mysqli_fetch_array($result)){
            print("<tr>\n");
            print("<td>" . $row['nume']. "</td>\n");
            print("<td>" . $row['prenume']. "</td>\n");
            print("<td>" . $row['clasa']. "</td>\n");
            print("</tr>\n");
        }
        print("</table>");
    } else {
        print "Nu exista intrari in agenda!";
    }
    ?>
    </div>
    </div>

    <div class="box-shadow mb-3">
    <h1 class="page-title">Elevii din clasele 11-12 inscrisi la concurs:</h1>
    <div class="box-shadow mb-3 page-table align-middle">
    <?php
    /** Afisarea numerelor din agenda */
    $query = "SELECT * FROM clasele11_12";
    $result = mysqli_query($conexiune, $query);
    if(mysqli_num_rows($result)) {
        print("<table>\n");
        print("<tr>\n");
        print("<th>Nume</th><th>Prenume</th><th>Clasa</th>");
        print("</tr>\n");
        while($row = mysqli_fetch_array($result)){
            print("<tr>\n");
            print("<td>" . $row['nume']. "</td>\n");
            print("<td>" . $row['prenume']. "</td>\n");
            print("<td>" . $row['clasa']. "</td>\n");
            print("</tr>\n");
        }
        print("</table>");
    } else {
        print "Nu exista intrari in agenda!";
    }
    ?>
    </div>
    </div>
</div>

<?php
    include "footer.php";
?>