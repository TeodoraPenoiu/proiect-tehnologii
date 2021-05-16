<?php
    /* Detaliile de conectare la baza de date */
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'concurenti');
    define('DB_USER', 'teo');
    define('DB_PASS', 'helloworld');

    /*Se reporteaza toate erorrile cu exceptia celor de tip NOTICE si DEPRECATED */
    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
?>