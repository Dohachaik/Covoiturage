<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Mon Profil</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($conducteur)): ?>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nom :</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo htmlspecialchars($conducteur['nom']); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Email :</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo htmlspecialchars($conducteur['email']); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Téléphone :</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo htmlspecialchars($conducteur['contact']); ?>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="index.php?action=modifierProfil" class="btn btn-primary">Modifier mon profil</a>
                        </div>
                    <?php else: ?>
                        <p class="text-danger">Erreur lors du chargement du profil.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?> 