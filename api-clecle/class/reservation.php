<?php
    class Reservation {
        // Connection
        private $conn;

        // Table
        private $db_table = "reservation";

        // Columns
        public $id_reservation;
        public $id_outil;
        public $client_name;
        public $date_fin;
        public $date_debut;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllReservation(){
            $sqlQuery = "SELECT id_reservation, id_outil, nom_utilisateur, date_fin, date_debut FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getOwner(){
            $sqlQuery = "SELECT
                        atelier.id_compte
                        FROM outil
                        JOIN etagere ON etagere.id = outil.id_etagere
                        JOIN atelier ON atelier.id_atelier = etagere.id_atelier
                        WHERE 
                            outil.id = :id";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id", $this->id_outil);
        
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $dataRow['id_compte'];
        }

        public function checkTime(){
            $sqlQuery = "SELECT
                        id_reservation,
                        nom_utilisateur,
                        date_fin,
                        date_debut
                      FROM
                        ". $this->db_table .'
                    WHERE 
                        id_outil = :id_outil AND ((date_fin BETWEEN :datedeb1 AND :datefin1) OR (date_debut BETWEEN :datedeb2 AND :datefin2) OR (date_debut = :datedeb3 OR date_fin = :datefin2));';
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            
        
            $stmt->bindParam(":id_outil", $this->id_outil);
            
            $stmt->bindParam(":datedeb1", $this->date_debut);
            $stmt->bindParam(":datedeb2", $this->date_debut);
            $stmt->bindParam(":datedeb3", $this->date_debut);
            $stmt->bindParam(":datefin1", $this->date_fin);
            $stmt->bindParam(":datefin2", $this->date_fin);
            $stmt->bindParam(":datefin3", $this->date_fin);
        
            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            return ($dataRow==null);
        }
        // CREATE
        public function createReservation(){
            
            $isGood = $this->checkTime();
            if(!$isGood)
                return false;
            

            
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_outil = :id_outil,
                        nom_utilisateur = :client_name,
                        date_fin = :date_fin,
                        date_debut = :date_debut;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_outil", $this->id_outil);
            $stmt->bindParam(":client_name", $this->client_name);
            $stmt->bindParam(":date_fin", $this->date_fin);
            $stmt->bindParam(":date_debut", $this->date_debut);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ with etagere
        public function getReservationFromOutil(){
            $sqlQuery = "SELECT
                        id_reservation,
                        nom_utilisateur,
                        date_fin,
                        date_debut
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_outil = :id_outil
                        AND date_fin > :current
                    ORDER BY date_debut";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_outil", $this->id_outil);
            date_default_timezone_set('Europe/Paris');
            $datetoday = date("Y-m-d H:i:s");
            $stmt->bindParam(":current", $datetoday);
        
            $stmt->execute();
            return $stmt;
        }

        // READ single with id
        public function getReservationFromId(){
            $sqlQuery = "SELECT
                        id_reservation,
                        id_outil,
                        date_fin, 
                        date_debut
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_reservation = :id_reservation
                        AND date_fin > :current";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":id_reservation", $this->id_reservation);
            date_default_timezone_set('Europe/Paris');
            $stmt->bindParam(":current", date("Y-m-d H:i:s"));
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            
        
            $this->id_outil = $dataRow['id_outil'];
            $this->client_name = $dataRow['nom_utilisateur'];
            $this->date_fin = $dataRow['date_fin'];
            $this->date_debut = $dataRow['date_debut'];

            return $this;
        }

         // UPDATE
        public function updateReservation(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_outil = :id_outil, 
                        date_fin = :date_fin,
                        date_debut = :date_debut
                    WHERE 
                        id_reservation = :id_reservation";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_reservation=htmlspecialchars(strip_tags($this->id_reservation));
            $this->id_outil=htmlspecialchars(strip_tags($this->id_outil));
            $this->date_fin=htmlspecialchars(strip_tags($this->date_fin));
            $this->date_debut=htmlspecialchars(strip_tags($this->date_debut));
        
           
            $stmt->bindParam(":id_reservation", $this->id_reservation);
            $stmt->bindParam(":id_outil", $this->id_outil);
            $stmt->bindParam(":date_fin", $this->date_fin);
            $stmt->bindParam(":date_debut", $this->date_debut);
            
            if($stmt->execute()){
               return true;
            }
            return false;
           
        }

        // DELETE
        public function deleteReservationFromId(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_reservation = :id_reservation";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_reservation=htmlspecialchars(strip_tags($this->id_reservation));
        
            $stmt->bindParam(":id_reservation", $this->id_reservation);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>