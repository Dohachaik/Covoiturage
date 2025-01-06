<?php
class TrajetController {
    private $trajetModel;
    private $conducteurModel;
    private $reservationModel;

    public function __construct() {
        $this->trajetModel = new TrajetModel();
        $this->conducteurModel = new ConducteurModel();
        $this->reservationModel = new ReservationModel();
    }

    public function accueil() {
        include 'views/accueilView.php';
    }

    public function recherche() {
        $villes = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir'];
        include 'views/rechercheTrajetView.php';
    }

    public function resultatRecherche() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $depart = $_POST['depart'];
            $destination = $_POST['destination'];
            $date = $_POST['date'];
            
            $trajets = $this->trajetModel->rechercherTrajets($depart, $destination, $date);
            include 'views/resultatRechercheView.php';
        }
    }

    public function creerTrajet() {
        if (!isset($_SESSION['conducteur_id'])) {
            header('Location: index.php?controller=conducteur&action=connexion');
            return;
        }
        $villes = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trajet = $this->trajetModel->creerTrajet(
                $_SESSION['conducteur_id'],
                $_POST['depart'],
                $_POST['destination'],
                $_POST['date_depart'],
                $_POST['heure_depart'],
                $_POST['prix'],
                $_POST['type_voiture'],
                $_POST['places_disponibles']
            );

            if ($trajet) {
                header('Location: index.php?controller=trajet&action=mesTrajets');
                return;
            }
        }

        include 'views/creerTrajetView.php';
    }

    public function mesTrajets() {
        if (!isset($_SESSION['conducteur_id'])) {
            header('Location: index.php?action=connexion');
            exit();
        }

        $conducteur_id = $_SESSION['conducteur_id'];
        $trajets = $this->trajetModel->getTrajetsConducteur($conducteur_id);
        
        require_once('views/mesTrajetsView.php');
    }

    public function supprimerTrajet() {
        if (!isset($_SESSION['conducteur_id'])) {
            header('Location: index.php?action=connexion');
            exit();
        }

        if (isset($_POST['trajet_id'])) {
            $trajet_id = $_POST['trajet_id'];
            $conducteur_id = $_SESSION['conducteur_id'];
            
            if ($this->trajetModel->supprimerTrajet($trajet_id, $conducteur_id)) {
                $_SESSION['message'] = "Le trajet a été supprimé avec succès.";
            } else {
                $_SESSION['erreur'] = "Erreur lors de la suppression du trajet.";
            }
        }
        
        header('Location: index.php?action=mesTrajets');
        exit();
    }

    public function updatePlacesRestantes() {
        if (isset($_POST['trajet_id'])) {
            $trajet_id = $_POST['trajet_id'];
            
            if ($this->trajetModel->updatePlacesRestantes($trajet_id)) {
                return true;
            }
        }
        return false;
    }
}
?> 