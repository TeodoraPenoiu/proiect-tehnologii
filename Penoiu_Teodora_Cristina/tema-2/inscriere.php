<?php
    require_once "connect.php";
    include "header.php";
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
    include "footer.php";
?>
