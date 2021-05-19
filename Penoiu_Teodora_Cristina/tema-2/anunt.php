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
                    <li><a class="dropdown-item" href="admin/index.php">Intra in cont</a></li>
                    <li><a class="dropdown-item" href="inscriere.php">Inscriete-te!</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<main>

<?php
    require_once "inc/connect.php";
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
/** Afisarea mesajelor din guestbook */
$query = "SELECT id, titlu, paragraf FROM anunturi";
$result = mysqli_query($conexiune, $query);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $vtitlu = htmlspecialchars($row['titlu']);
        $vparagraf = htmlspecialchars($row['paragraf']);
        echo '<div class="noutate-container">';
        echo '<div><img class="image-wrapper float-start" src="assets/img/exclamation-mark.jpg" alt="poza cu un semn al exclamarii"></div>
<div class="float-md-end noutate-content"><h2 class="page-third-title mb-3 mt-0">';
        printf($vtitlu);
        echo '</h2><p>';
        printf($vparagraf);
        echo '</p></div><div class="cleaner"></div></div>';
    }
}
?>

</main>

<footer class="mt-auto footer-background footer-display">
    <div class="container">
        <h3 class="footer-title">DESPRE CONCURS</h3>
        <p class="footer-text flex-direction">Concursul este destinat tuturor elevilor de gimnaziu și liceu<br> care se pot încadra în probele concursului. Un elev poate<br> participa la una sau mai multe probe.</p>
        <p class="footer-text float-md-end"> &copy;Penoiu Teodora Cristina </p>
    </div>
</footer>

</body>
</html>
