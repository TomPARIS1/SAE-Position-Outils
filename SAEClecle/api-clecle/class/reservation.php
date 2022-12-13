<?php
    class Reservation {
        // Connection
        private $conn;

        // Table
        private $db_table = "reservation";

        // Columns
        public $id_reservation;
        public $id_outil;
        public $date_fin;
        public $date_debut;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllReservation(){
            $sqlQuery = "SELECT id_reservation, id_outil, date_fin, date_debut FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createReservation(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_outil = :id_outil,
                        date_fin = :date_fin,
                        date_debut = :date_debut;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_outil", $this->id_outil);
            $stmt->bindParam(":date_fin", $this->date_fin);
            $stmt->bindParam(":date_debut", $this->date_debut);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ with etagere
        public function getReservationFromOutil($id_outil){
            $sqlQuery = "SELECT
                        id_reservation,
                        date_fin,
                        date_debut
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_outil = :id_outil";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_outil", $id_outil);
        
            $stmt->execute();
        
            return $stmt;
        }

        public function checkReservation()
        {
            // TODO: trouver un moyen d'être smart

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
                        id_reservation = :id_reservation";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":id_reservation", $this->id_reservation);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        
            $this->id_outil = $dataRow['id_outil'];
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
                        x = :date_fin,
                        y = :date_debut
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