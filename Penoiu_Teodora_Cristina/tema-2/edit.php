<?php

include "connect.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($conexiune,"select * from anunturi where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $titlu = $_POST['titlu'];
    $paragraf = $_POST['paragraf'];

    $edit = mysqli_query($conexiune,"update anunturi set titlu='$titlu', paragraf='$paragraf' where id='$id'");

    if($edit)
    {
        mysqli_close($conexiune); // Close connection
        header("location:anunt.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }
}
?>

<div>
    <h3>Update Data</h3>

    <form action="" method="POST">
        <input type="text" name="titlu" value="<?php echo $data['titlu']; ?>">
        <input type="text" name="paragraf" value="<?php echo $data['paragraf']; ?>">
        <input type="submit" name="update" value="Update">
    </form>
</div>