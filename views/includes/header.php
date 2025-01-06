<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Covoiturage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <?php if (isset($_SESSION['conducteur_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=mesTrajets">Mes Trajets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=creerTrajet">Créer un Trajet</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['conducteur_id'])): ?>
                        <li class="nav-item">
                            <span class="nav-link">Bienvenue, <?php echo htmlspecialchars($_SESSION['conducteur_nom']); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=profil">Mon Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=deconnexion">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=connexion">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=inscription">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html> 