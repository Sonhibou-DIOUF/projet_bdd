<?php
session_start();
include "connexion_bdd.php";
echo "un cookie a été recu". $_COOKIE['email'];
/*
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}
*/

// Requête SELECT

$query = "SELECT * FROM Client";
$result = mysqli_query($conn,$query);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "nom: ".$row['nom']. "----email: ".  $row['email']. "<br>";
    }

}


if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}

// Requête de modification (UPDATE)
$query = "UPDATE Client SET email = 'nouveau.email@example.com', telephone = '0620202020' WHERE id_client = 5";

if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}

// Requête de suppression (DELETE)
$query= "DELETE FROM Client WHERE id_client = 5";
if ($mysqli_query = mysqli_query($conn, $query)){
    echo 'reussi';
}else{
    echo 'erreur'.mysqli_error($conn);
}


mysqli_close($conn);
?>