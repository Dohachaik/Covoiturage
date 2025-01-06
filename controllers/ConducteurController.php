<?php
class ConducteurController {
    private $conducteurModel;

    public function __construct() {
        $this->conducteurModel = new ConducteurModel();
    }

    public function inscription() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de l'upload de la photo
            $photo = '';
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
                $uploadDir = 'assets/images/conducteurs/';
                $photo = uniqid() . '_' . $_FILES['photo']['name'];
                move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $photo);
            }

            $resultat = $this->conducteurModel->creerConducteur(
                $_POST['nom'],
                $_POST['contact'],
                $_POST['email'],
                $photo,
                $_POST['cin'],
                $_POST['password']
            );

            if ($resultat) {
                header('Location: index.php?controller=conducteur&action=connexion');
                return;
            }
        }
        include 'views/inscriptionView.php';
    }

    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conducteur = $this->conducteurModel->verifierConnexion(
                $_POST['email'],
                $_POST['password']
            );

            if ($conducteur) {
                $_SESSION['conducteur_id'] = $conducteur['id'];
                $_SESSION['conducteur_nom'] = $conducteur['nom'];
                header('Location: index.php?controller=trajet&action=mesTrajets');
                return;
            } else {
                $erreur = "Email ou mot de passe incorrect";
            }
        }
        include 'views/connexionView.php';
    }

    public function profil() {
        if (!isset($_SESSION['conducteur_id'])) {
            header('Location: index.php?action=connexion');
            exit();
        }

        $conducteur = $this->conducteurModel->getConducteurById($_SESSION['conducteur_id']);
        require_once('views/profilView.php');
    }

    public function deconnexion() {
        session_destroy();
        header('Location: index.php');
    }
}
?> 