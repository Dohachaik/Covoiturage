<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mes Trajets - Covoiturage</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'views/includes/header.php'; ?>

    <div class="container mt-4">
        <h2>Mes Trajets</h2>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['erreur'];
                unset($_SESSION['erreur']);
                ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($trajets as $trajet): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($trajet['depart']); ?> → <?php echo htmlspecialchars($trajet['destination']); ?></h5>
                            <p class="card-text">
                                <strong>Date:</strong> <?php echo htmlspecialchars($trajet['date_depart']); ?><br>
                                <strong>Heure:</strong> <?php echo htmlspecialchars($trajet['heure_depart']); ?><br>
                                <strong>Prix:</strong> <?php echo htmlspecialchars($trajet['prix']); ?> €<br>
                                <strong>Places restantes:</strong> <?php echo htmlspecialchars($trajet['places_restantes']); ?>
                            </p>
                            <form action="index.php?action=supprimerTrajet" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?');">
                                <input type="hidden" name="trajet_id" value="<?php echo $trajet['id']; ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require_once 'views/includes/footer.php'; ?>
</body>
</html> 