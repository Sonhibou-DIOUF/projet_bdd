<?php
include "../connexion_bdd.php";
//
$query = "UPDATE Transaction SET type_transaction = 'facture' WHERE id_seance = 1";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else {
    echo 'erreur' . mysqli_error($conn);
}
mysqli_close($conn);

?>