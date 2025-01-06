<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage - Accueil</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fc;
    color: #333;
}

header {
    background-color: #fff;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.logo {
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
}

.menu a {
    margin-right: 15px;
    text-decoration: none;
    color: #333;
}

.menu a:hover {
    color: #007bff;
}

.hero {
    background: linear-gradient(to bottom, #002b8a, #007bff);
    color: white;
    text-align: center;
    padding: 60px 20px;
}

.hero h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
}

.search-box {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.btn {
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 5px;
    font-size: 1em;
    text-align: center;
    display: inline-block;
}

.btn-primary {
    background-color: #0056b3;
    color: white;
}

.btn-primary:hover {
    background-color: #003d82;
}

.btn-secondary {
    background-color: #ff4500;
    color: white;
}

.btn-secondary:hover {
    background-color: #cc3700;
}

.section-choice {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 20px;
    gap: 20px;
}

.choice-card {
    background: white;
    border-radius: 10px;
    padding: 30px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

.choice-card h2 {
    font-size: 1.5em;
    color: #0056b3;
    margin-bottom: 10px;
}

.choice-card p {
    margin-bottom: 20px;
    color: #666;
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #fff;
    border-top: 1px solid #ddd;
}

footer p {
    margin: 0;
    color: #888;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Covoiturage</div>
            <div class="menu">
                <a href="index.php">Accueil</a>
                <?php if (isset($_SESSION['conducteur_id'])): ?>
                    <a href="index.php?controller=trajet&action=mesTrajets">Mes Trajets</a>
                    <a href="index.php?controller=conducteur&action=profil">Mon Profil</a>
                    <a href="index.php?controller=conducteur&action=deconnexion">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?controller=conducteur&action=connexion">Connexion</a>
                    <a href="index.php?controller=conducteur&action=inscription">Inscription</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Bienvenue sur notre service de covoiturage</h1>
            <p>Simplifiez vos trajets, économisez du temps et de l'argent !</p>
        </section>

        <section class="section-choice">
            <div class="choice-card">
                <h2>Je suis conducteur</h2>
                <p>Proposez des trajets et gagnez de l'argent</p>
                <a href="index.php?controller=conducteur&action=connexion" class="btn btn-primary">Connexion</a>
                <a href="index.php?controller=conducteur&action=inscription" class="btn btn-secondary">Inscription</a>
            </div>
            <div class="choice-card">
                <h2>Je suis passager</h2>
                <p>Trouvez un trajet à petit prix</p>
                <a href="index.php?controller=trajet&action=recherche" class="btn btn-primary">Rechercher un trajet</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Covoiturage. Tous droits réservés.</p>
    </footer>
</body>
</html>
