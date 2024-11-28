<?php
include "../connexion_bdd.php";
//
$query = "?";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else {
    echo 'erreur' . mysqli_error($conn);
}
mysqli_close($conn);

?>