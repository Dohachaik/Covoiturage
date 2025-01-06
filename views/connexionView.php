<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Covoiturage</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="connexion-section">
            <h2>Connexion</h2>
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
            <?php endif; ?>

            <form action="index.php?controller=conducteur&action=connexion" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <p class="text-center">
                Pas encore de compte ? 
                <a href="index.php?controller=conducteur&action=inscription">S'inscrire</a>
            </p>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 