
<?php
include "../../login/connexion_bdd.php";

// Gestion de l'ajout d'une transaction
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $montant = $_POST['montant'];
    $date_transaction = $_POST['date_transaction'];
    $type_transaction = $_POST['type_transaction'];

    // Requête d'insertion
    $sql = "INSERT INTO Transaction (montant, date_transaction, type_transaction) 
            VALUES ('$montant', '$date_transaction', '$type_transaction')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Transaction ajoutée avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur : " . mysqli_error($conn) . "');</script>";
    }
}

// Récupération des transactions existantes
$sql_transactions = "SELECT id_transaction, montant ,date_transaction , type_transaction , Seance.date_seance AS date_seance, Seance.lieu AS lieu_seance
FROM Transaction JOIN Seance ON Transaction.id_seance = Seance.id_seance";
$result_transactions = mysqli_query($conn, $sql_transactions);


?>
<?php
include "../../composants/header.php";
include "../../composants/navbar.php";
include "../../composants/sidebar.php";
?>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Gestion des Transactions</h1>

    <!-- Formulaire d'ajout de transaction -->
    <div class="card mb-4">
        <div class="card-header">Ajouter une nouvelle transaction</div>
        <div class="card-body">
            <form action="transactions.php" method="post">
                <div class="mb-3">
                    <label for="montant" class="form-label">Montant</label>
                    <input type="number" id="montant" name="montant" class="form-control" placeholder="Montant" required>
                </div>
                <div class="mb-3">
                    <label for="date_transaction" class="form-label">Date de la transaction</label>
                    <input type="date" id="date_transaction" name="date_transaction" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="type_transaction" class="form-label">Type de transaction</label>
                    <select id="type_transaction" name="type_transaction" class="form-select" required>
                        <option value="" disabled selected>Choisissez un type</option>
                        <option value="paiement">Paiement</option>
                        <option value="pacture">Facture</option>
                    </select>
                </div>
                <div>


                    <select  id="type_transaction" name="type_transaction" class="form-select" required>

                        <option value="" disabled selected>Choisissez une Seance</option>
                        <?php
                        $sql = "SELECT * FROM Seance ";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0):
                            while ($row = $result->fetch_assoc()):
                                echo '<option value="'.$row['id_seance']. '">'.$row["date_seance"].'  du client '.$row["id_client"].'</option>';
                            endwhile;

                        endif;
                        ?>


                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des transactions -->
    <div class="card">
        <div class="card-header">Liste des Transactions</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Seance</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($result_transactions->num_rows > 0): ?>
                    <?php while ($row = $result_transactions->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_transaction']; ?></td>
                            <td><?php echo $row['montant']; ?> €</td>
                            <td><?php echo $row['date_transaction']; ?></td>
                            <td><?php echo $row['type_transaction']; ?></td>
                            <td><?php echo $row['date_seance'] . ' ' . $row['lieu_seance']; ?></td>

                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucune transaction trouvée</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
mysqli_close($conn);
?>