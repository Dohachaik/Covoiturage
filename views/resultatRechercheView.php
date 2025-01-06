<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - Covoiturage</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'views/includes/header.php'; ?>

    <div class="container mt-4">
        <h2>Résultats de la recherche</h2>
        
        <?php if (empty($trajets)): ?>
            <div class="alert alert-info">
                Aucun trajet ne correspond à votre recherche.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($trajets as $trajet): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo htmlspecialchars($trajet['depart']); ?> → 
                                    <?php echo htmlspecialchars($trajet['destination']); ?>
                                </h5>
                                <p class="card-text">
                                    <strong>Date:</strong> <?php echo htmlspecialchars($trajet['date_depart']); ?><br>
                                    <strong>Heure:</strong> <?php echo htmlspecialchars($trajet['heure_depart']); ?><br>
                                    <strong>Prix:</strong> <?php echo htmlspecialchars($trajet['prix']); ?> €<br>
                                    <strong>Places restantes:</strong> <?php echo htmlspecialchars($trajet['places_restantes']); ?><br>
                                    <strong>Conducteur:</strong> <?php echo htmlspecialchars($trajet['conducteur_nom']); ?>
                                </p>
                                <form action="index.php?action=reservationDetails" method="POST">
                                    <input type="hidden" name="trajet_id" value="<?php echo $trajet['id']; ?>">
                                    <button type="submit" class="btn btn-primary">Réserver</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php require_once 'views/includes/footer.php'; ?>
    
    <script>
    function confirmReservation() {
        if (confirm("Voulez-vous confirmer cette réservation ?")) {
            alert("Réservation effectuée avec succès !");
            // Redirection vers l'accueil après la confirmation
            window.location.href = 'index.php';
            return false;
        }
        return false;
    }
    </script>
</body>
</html> 