<?php
include "../connexion_bdd.php";
//

$query = "UPDATE Seance SET lieu = 'Salon de la Bourgeonière' WHERE id_seance= 9 AND id_phtographe = 9";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else {
    echo 'erreur' . mysqli_error($conn);
}
mysqli_close($conn);

?>