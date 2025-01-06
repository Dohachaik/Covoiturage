<?php
class ReservationController {
    private $reservationModel;
    private $trajetModel;
    private $db;

    public function __construct() {
        $this->reservationModel = new ReservationModel();
        $this->trajetModel = new TrajetModel();
        
    }

    public function reserver() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trajet_id = $_POST['trajet_id'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];

            // Créer la réservation
            if ($this->reservationModel->creerReservation($trajet_id, $nom, $email)) {
                // Charger les détails du trajet pour la vue
                $trajet = $this->trajetModel->getTrajet($trajet_id);
                $_SESSION['success'] = "Votre réservation a été effectuée avec succès !";
                require_once('views/reservationView.php'); // Afficher la même vue avec le message
            } else {
                $_SESSION['erreur'] = "Erreur lors de la réservation. Places peut-être épuisées.";
                header('Location: index.php?action=reservationDetails&trajet_id=' . $trajet_id);
                exit();
            }
        }
    }


    public function voirReservations() {
        if (!isset($_SESSION['trajet_id'])) {
            header('Location: index.php');
            exit();
        }

        $trajet_id = $_SESSION['trajet_id'];
        $reservations = $this->reservationModel->getReservationsParTrajet($trajet_id);
        require_once('views/listeReservationsView.php');
    }

    public function afficherDetails() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trajet_id'])) {
            $trajet_id = $_POST['trajet_id'];
            $trajet = $this->trajetModel->getTrajet($trajet_id);
            
            if ($trajet) {
                require_once('views/reservationView.php');
            } else {
                $_SESSION['erreur'] = "Trajet non trouvé.";
                header('Location: index.php?action=recherche');
                exit();
            }
        } else {
            header('Location: index.php?action=recherche');
            exit();
        }
    }
}
?> 