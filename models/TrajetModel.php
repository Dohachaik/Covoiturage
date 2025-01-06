<?php
class TrajetModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function creerTrajet($conducteur_id, $depart, $destination, $date_depart, 
                              $heure_depart, $prix, $type_voiture, $places_disponibles) {
        $sql = "INSERT INTO trajets (conducteur_id, depart, destination, date_depart, 
                heure_depart, prix, type_voiture, places_disponibles, places_restantes) 
                VALUES (:conducteur_id, :depart, :destination, :date_depart, 
                :heure_depart, :prix, :type_voiture, :places_disponibles, :places_disponibles)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':conducteur_id' => $conducteur_id,
            ':depart' => $depart,
            ':destination' => $destination,
            ':date_depart' => $date_depart,
            ':heure_depart' => $heure_depart,
            ':prix' => $prix,
            ':type_voiture' => $type_voiture,
            ':places_disponibles' => $places_disponibles
        ]);
    }

    public function rechercherTrajets($depart, $destination, $date) {
        $sql = "SELECT t.*, c.nom as conducteur_nom 
                FROM trajets t 
                JOIN conducteurs c ON t.conducteur_id = c.id 
                WHERE t.depart = :depart 
                AND t.destination = :destination 
                AND t.date_depart = :date 
                AND t.places_restantes > 0";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':depart' => $depart,
            ':destination' => $destination,
            ':date' => $date
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrajetsConducteur($conducteur_id) {
        $sql = "SELECT * FROM trajets WHERE conducteur_id = :conducteur_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':conducteur_id' => $conducteur_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerTrajet($id, $conducteur_id) {
        $sql = "DELETE FROM trajets WHERE id = :id AND conducteur_id = :conducteur_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id, ':conducteur_id' => $conducteur_id]);
    }

    public function updatePlacesRestantes($trajet_id) {
        $sql = "UPDATE trajets 
                SET places_restantes = places_restantes - 1 
                WHERE id = :trajet_id AND places_restantes > 0";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':trajet_id' => $trajet_id]);
    }

    public function incrementerPlacesRestantes($trajet_id) {
        $sql = "UPDATE trajets 
                SET places_restantes = places_restantes + 1 
                WHERE id = :trajet_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':trajet_id' => $trajet_id]);
    }

    public function getTrajet($trajet_id) {
        $sql = "SELECT * FROM trajets WHERE id = :trajet_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':trajet_id' => $trajet_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 