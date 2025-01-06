<?php
class ConducteurModel {
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

    public function creerConducteur($nom, $contact, $email, $photo, $cin, $password) {
        $sql = "INSERT INTO conducteurs (nom, contact, email, photo, cin, password) 
                VALUES (:nom, :contact, :email, :photo, :cin, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':contact' => $contact,
            ':email' => $email,
            ':photo' => $photo,
            ':cin' => $cin,
            ':password' => $password
        ]);
    }

    public function verifierConnexion($email, $password) {
        $sql = "SELECT * FROM conducteurs WHERE email = :email AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email, ':password' => $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getConducteurById($id) {
        $sql = "SELECT * FROM conducteurs WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateConducteur($id, $nom, $contact, $photo, $password) {
        $sql = "UPDATE conducteurs 
                SET nom = :nom, contact = :contact, photo = :photo, password = :password 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':contact' => $contact,
            ':photo' => $photo,
            ':password' => $password
        ]);
    }
}
?> 