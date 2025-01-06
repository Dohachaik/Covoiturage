<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un trajet - Covoiturage</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="creer-trajet-section">
            <h2>Publier un trajet</h2>
            <form action="index.php?controller=trajet&action=creerTrajet" method="POST">
                <div class="form-group">
                    <label for="depart">Ville de départ</label>
                    <select name="depart" id="depart" required>
                        <option value="">Sélectionnez une ville</option>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?= htmlspecialchars($ville) ?>"><?= htmlspecialchars($ville) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="destination">Ville de destination</label>
                    <select name="destination" id="destination" required>
                        <option value="">Sélectionnez une ville</option>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?= htmlspecialchars($ville) ?>"><?= htmlspecialchars($ville) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_depart">Date de départ</label>
                    <input type="date" name="date_depart" id="date_depart" required min="<?= date('Y-m-d') ?>">
                </div>

                <div class="form-group">
                    <label for="heure_depart">Heure de départ</label>
                    <input type="time" name="heure_depart" id="heure_depart" required>
                </div>

                <div class="form-group">
                    <label for="prix">Prix par personne </label>
                    <input type="number" name="prix" id="prix" required min="0">
                </div>

                <div class="form-group">
                    <label for="type_voiture">Type de voiture</label>
                    <input type="text" name="type_voiture" id="type_voiture" required>
                </div>

                <div class="form-group">
                    <label for="places_disponibles">Nombre de places disponibles</label>
                    <input type="number" name="places_disponibles" id="places_disponibles" required min="1" max="8">
                </div>

                <button type="submit" class="btn btn-primary">Publier le trajet</button>
            </form>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 