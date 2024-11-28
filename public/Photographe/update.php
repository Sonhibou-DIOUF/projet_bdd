<?php
include "../connexion_bdd.php";
//

$query = "UPDATE Photographe SET specialite = 'Sport' WHERE id_photographe = 8";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else {
    echo 'erreur' . mysqli_error($conn);
}
mysqli_close($conn);

?>