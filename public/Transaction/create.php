<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'PicturMe';

//On établit la connexion
$conn = mysqli_connect($servername, $username, $password,$database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST['montant'];
    $date_transaction = $_POST['date_transaction'];
    $type_transaction = $_POST['type_transaction'];
    $sql = "INSERT INTO Transaction ( montant, date_transaction, type_transaction) VALUES ('$montant', '$date_transaction', '$type_transaction')";
    mysqli_query($conn, $sql);
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<head>
    <title>Transaction</title>
    <meta charset="utf-8"></meta>
</head>
<body>

</body>
<form action="create.php" method="post">
    <div>
        <label for="montant">Montant</label>
        <input type="number" id="montant" name="montant" placeholder="Montant">
    </div>
    <div>
        <label for="date_transaction">Date de la transaction</label>
        <input type="date" id="date" name="date_transaction" placeholder="date">
    </div>
    <div>
        <label for="type_transaction">Type de transaction</label>
        <input type="text" id="type_transaction" name="type_transaction" placeholder="Type de transaction">
    </div>
    <div>
        <label for="soumetttre">Soumettre</label>
        <input type="submit" name="S'inscrire" value="Envoyer"></input>
    </div>

</form>