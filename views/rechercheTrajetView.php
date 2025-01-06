<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un trajet</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="recherche-section">
            <h2>Rechercher un trajet</h2>
            <form action="index.php?controller=trajet&action=resultatRecherche" method="POST">
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
                    <label for="date">Date du trajet</label>
                    <input type="date" name="date" id="date" required min="<?= date('d-m-y') ?>">
                </div>

                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 