<?php
class ReservationModel {
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

    public function creerReservation($trajet_id, $utilisateur_nom, $utilisateur_email) {
        try {
            $this->db->beginTransaction();

            // Vérifie les places disponibles
            $sql_verify = "SELECT places_restantes FROM trajets WHERE id = :trajet_id";
            $stmt = $this->db->prepare($sql_verify);
            $stmt->execute([':trajet_id' => $trajet_id]);
            $trajet = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$trajet || $trajet['places_restantes'] <= 0) {
                $this->db->rollBack();
                return false;
            }

            // Insère la réservation
            $sql_insert = "INSERT INTO reservations (trajet_id, utilisateur_nom, utilisateur_email, 
                                                   date_reservation, paiement_effectue) 
                          VALUES (:trajet_id, :utilisateur_nom, :utilisateur_email, 
                                 CURRENT_TIMESTAMP, TRUE)";
            
            $stmt = $this->db->prepare($sql_insert);
            $success = $stmt->execute([
                ':trajet_id' => $trajet_id,
                ':utilisateur_nom' => $utilisateur_nom,
                ':utilisateur_email' => $utilisateur_email
            ]);

            if (!$success) {
                $this->db->rollBack();
                return false;
            }

            // Met à jour les places restantes
            $sql_update = "UPDATE trajets 
                          SET places_restantes = places_restantes - 1 
                          WHERE id = :trajet_id";
            $stmt = $this->db->prepare($sql_update);
            $success = $stmt->execute([':trajet_id' => $trajet_id]);

            if (!$success) {
                $this->db->rollBack();
                return false;
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function validerPaiement($reservation_id) {
        $sql = "UPDATE reservations SET paiement_effectue = TRUE WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $reservation_id]);
    }

    public function getReservationsParTrajet($trajet_id) {
        $sql = "SELECT * FROM reservations WHERE trajet_id = :trajet_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':trajet_id' => $trajet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservation($reservation_id) {
        $sql = "SELECT * FROM reservations WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $reservation_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function supprimerReservation($reservation_id) {
        $sql = "DELETE FROM reservations WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $reservation_id]);
    }
}
?> 