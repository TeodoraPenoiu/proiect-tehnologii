<?php

    function doLogin($user, $password) {
    global $conexiune;
    $logat = FALSE;
    if (isLogged())
        doLogout();

    $sql = sprintf("SELECT * FROM admin WHERE username='%s' AND password= md5('%s')",
    mysqli_real_escape_string($conexiune, $user),
    mysqli_real_escape_string($conexiune, $password));
    //echo "Query: $sql <br>";
    if (!($result = mysqli_query($conexiune, $sql))) {
    echo('Error: ' . mysqli_error($conexiune));
    }
    if ($row = mysqli_fetch_array($result)) {
    $logat = TRUE;
    $_SESSION['user'] = $user;
    $_SESSION['logat'] = TRUE;
    }
    return $logat;
    }

    function doLogout() {
        unset($_SESSION['user']);
        unset($_SESSION['logat']);
    }

    function isLogged() {
        return isset($_SESSION['logat']) && $_SESSION['logat'] == TRUE;
    }

    function getLoggedUser() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
    }
?>