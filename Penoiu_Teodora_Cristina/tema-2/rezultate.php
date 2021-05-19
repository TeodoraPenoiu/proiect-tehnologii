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
                    <li><a class="dropdown-item" href="admin/index.php">Intra in cont</a></li>
                    <li><a class="dropdown-item" href="inscriere.php">Inscriete-te!</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<main>

    <h1 class="page-title">Rezultate</h1>

<?php
    require_once "inc/connect.php";
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
            echo '</td></tr>';
        }
        echo '</table>';
    } else {
        print "Nu exista intrari in agenda!";
    }
    ?>
    </div>


<?php
    include "inc/footer.php";
?>
