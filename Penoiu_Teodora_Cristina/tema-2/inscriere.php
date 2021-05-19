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
                    <li><a class="dropdown-item" href="admin/index.php">Intra in cont</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<main>

<?php
    require_once "inc/connect.php";
?>

<?php
$comanda = isset($_REQUEST['comanda']) ? $_REQUEST['comanda'] : "";
if (!empty($comanda)) {
    switch ($comanda){
        case 'add':
            $nume = $_REQUEST["nume"];
            $prenume = $_REQUEST["prenume"];
            $clasa = $_REQUEST["clasa"];
            $email = $_REQUEST["email"];
            $parola = $_REQUEST["parola"];

//TODO: Aici trebuie adaugat cod ce valideaza datele.

            if($clasa == 5 || $clasa == 6)
                $sql="INSERT INTO clasele5_6(nume, prenume, clasa, email, parola) VALUES ('$nume', '$prenume', '$clasa', '$email', '$parola')";

            if($clasa == 7 || $clasa == 8)
                $sql="INSERT INTO clasele7_8(nume, prenume, clasa, email, parola) VALUES ('$nume', '$prenume', '$clasa', '$email', '$parola')";

            if($clasa == 9 || $clasa == 10)
                $sql="INSERT INTO clasele9_10(nume, prenume, clasa, email, parola) VALUES ('$nume', '$prenume', '$clasa', '$email', '$parola')";

            if($clasa == 11 || $clasa == 12)
                $sql="INSERT INTO clasele11_12(nume, prenume, clasa, email, parola) VALUES ('$nume', '$prenume', '$clasa', '$email', '$parola')";

            $connect = $conexiune;
            if (!mysqli_query($connect, $sql)) {
                die('Error: ' . mysqli_error($connect));
            }
            break;
    }
}
?>
    <h1 class="page-title">Ne bucuram ca esti interesat de concursul nostru!</h1>
    <h2 class="page-second-title">Inscrie-te acum ca sa iei parte la el!</h2>

<form action="inscriere.php" method="post">
    <input name="comanda" type="hidden" value="add" />
    <div class="put-middle box-shadow mb-3" style="width: fit-content">
    <table class="mb-3" style="width: fit-content">
        <tr>
            <th><label for="surname">NUME:*</label></th>
            <td><input id="surname" type="text" placeholder="..." name="nume"></td>
        </tr>

        <tr>
            <th><label for="name">PRENUME:*</label></th>
            <td><input id="name" type="text" placeholder="..." name="prenume"></td>
        </tr>

        <tr>
            <th><label for="class">CLASA:*</label></th>
            <td><input id="class" type="number" placeholder="..." name="clasa"></td>
        </tr>

        <tr>
            <th><label for="e-mail">EMAIL:*</label></th>
            <td><input id="e-mail" type="text" placeholder="..." name="email"></td>
        </tr>

        <tr>
            <th><label for="password">PAROLA:*</label></th>
            <td><input id="password" type="text" placeholder="..." name="parola"></td>
        </tr>
    </table>

        <input class="btn btn-primary mb-3 w-100" type="submit" value="INSCRIE-TE!" name="submit">

    </div>
</form>

<?php
    include "inc/footer.php";
?>
