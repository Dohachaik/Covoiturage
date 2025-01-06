<?php
session_start();
require_once 'config/config.php';

// Autoload des classes
spl_autoload_register(function($className) {
    $directories = ['models', 'controllers'];
    
    foreach ($directories as $directory) {
        $file = __DIR__ . "/$directory/$className.php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Router simple
$action = isset($_GET['action']) ? $_GET['action'] : 'accueil';

// Instanciation des contrôleurs
$trajetController = new TrajetController();
$conducteurController = new ConducteurController();
$reservationController = new ReservationController();

// Router
switch ($action) {
    case 'accueil':
        $trajetController->accueil();
        break;

    case 'mesTrajets':
        $trajetController->mesTrajets();
        break;

    case 'supprimerTrajet':
        $trajetController->supprimerTrajet();
        break;

    // Routes pour les réservations
    case 'reserver':
        $reservationController->reserver();
        break;


    case 'voirReservations':
        $reservationController->voirReservations();
        break;

    case 'confirmation':
        require_once('views/confirmationView.php');
        break;

    case 'recherche':
        $trajetController->recherche();
        break;

    case 'resultatRecherche':
        $trajetController->resultatRecherche();
        break;

    case 'creerTrajet':
        $trajetController->creerTrajet();
        break;

    // Routes pour l'authentification
    case 'connexion':
        $conducteurController->connexion();
        break;

    case 'inscription':
        $conducteurController->inscription();
        break;

    case 'deconnexion':
        $conducteurController->deconnexion();
        break;

    case 'profil':
        $conducteurController->profil();
        break;

    case 'reservationDetails':
        $reservationController->afficherDetails();
        break;

    default:
        // Page non trouvée
        header('HTTP/1.0 404 Not Found');
        include 'views/404View.php';
        break;
}
?> 