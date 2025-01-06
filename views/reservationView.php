<?php require_once 'views/includes/header.php'; ?>

<div class="container mt-4">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Détails de la réservation</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($trajet) && !empty($trajet['id'])): ?>
                        <div class="mb-4">
                            <h4>Trajet #<?php echo htmlspecialchars($trajet['id']); ?></h4>
                            <h4><?php echo htmlspecialchars($trajet['depart']); ?> → <?php echo htmlspecialchars($trajet['destination']); ?></h4>
                            <p>
                                <strong>Date:</strong> <?php echo htmlspecialchars($trajet['date_depart']); ?><br>
                                <strong>Heure:</strong> <?php echo htmlspecialchars($trajet['heure_depart']); ?><br>
                                <strong>Prix:</strong> <?php echo htmlspecialchars($trajet['prix']); ?> €<br>
                                
                            </p>
                        </div>

                        <form id="reservationForm" action="index.php?action=reserver" method="POST">
                            <input type="hidden" name="trajet_id" value="<?php echo htmlspecialchars($trajet['id']); ?>">
                            
                            <div class="mb-3">
                                <label for="nom" class="form-label">Votre nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Votre email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            Trajet non trouvé.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('reservationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const trajetId = this.querySelector('input[name="trajet_id"]').value;
    if (!trajetId) {
        alert('ID du trajet invalide');
        return;
    }

    if (confirm("Voulez-vous confirmer cette réservation ?")) {
        const formData = new FormData(this);
        
        fetch('index.php?action=reserver', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = 'index.php';
            } else {
                alert(data.message);
            }
        })
        
    }
});
</script>

<?php require_once 'views/includes/footer.php'; ?> 