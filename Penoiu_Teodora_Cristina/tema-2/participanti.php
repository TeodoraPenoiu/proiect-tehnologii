<?php
    require_once "connect.php";
    include "header.php";
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