<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Covoiturage</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="inscription-section">
            <h2>Inscription Conducteur</h2>
            <form action="index.php?controller=conducteur&action=inscription" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Nom complet</label>
                    <input type="text" name="nom" id="nom" required>
                </div>

                <div class="form-group">
                    <label for="contact">Téléphone</label>
                    <input type="tel" name="contact" id="contact" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="cin">CIN</label>
                    <input type="text" name="cin" id="cin" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="photo">Photo de profil</label>
                    <input type="file" name="photo" id="photo" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>

            <p class="text-center">
                Déjà inscrit ? 
                <a href="index.php?controller=conducteur&action=connexion">Se connecter</a>
            </p>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 