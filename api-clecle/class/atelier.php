<?php
    class Atelier {
        // Connection
        private $conn;

        // Table
        private $db_table = "atelier";

        // Columns
        public $id_compte;
        public $id_atelier;
        public $x;
        public $y;
        public $plan;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllAtelier(){
            $sqlQuery = "SELECT id_compte, id_atelier, x, y, plan FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        

        // CREATE
        public function createAtelier(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_compte = :id_compte,
                        x = :x,
                        y = :y,
                        plan = :plan;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_compte", $this->id_compte);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            $stmt->bindParam(":plan", $this->plan);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ with etagere
        public function getAtelierFromCompte($id_compte){
            $sqlQuery = "SELECT
                        id_compte,
                        id_atelier,
                        x, 
                        y,
                        plan
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_compte = :id_compte";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_compte", $id_compte);
        
            $stmt->execute();
        
            return $stmt;
        }

        // READ single with id
        public function getAtelierFromId(){
            $sqlQuery = "SELECT
                        id_compte,
                        id_atelier,
                        x, 
                        y,
                        plan
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_atelier = :id_atelier";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":id_atelier", $this->id_atelier);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        
            $this->id_compte = $dataRow['id_compte'];
            $this->x = $dataRow['x'];
            $this->y = $dataRow['y'];
            $this->plan = $dataRow['plan'];

            return $this;
        }

         // UPDATE
        public function updateAtelier(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_compte = :id_compte, 
                        x = :x,
                        y = :y,
                        plan = :plan
                    WHERE 
                        id_atelier = :id_atelier";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_compte=htmlspecialchars(strip_tags($this->id_compte));
            $this->x=htmlspecialchars(strip_tags($this->x));
            $this->y=htmlspecialchars(strip_tags($this->y));
            $this->id_atelier=htmlspecialchars(strip_tags($this->id_atelier));
            $this->plan=htmlspecialchars(strip_tags($this->plan));
        
           
            $stmt->bindParam(":id_compte", $this->id_compte);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            $stmt->bindParam(":plan", $this->plan);
            $stmt->bindParam(":id_atelier", $this->id_atelier);
            if($stmt->execute()){
               return true;
            }
            return false;
           
        }

        // DELETE
        public function deleteEtagereFromId(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_atelier = :id_atelier";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_atelier=htmlspecialchars(strip_tags($this->id_atelier));
        
            $stmt->bindParam(":id_atelier", $this->id_atelier);
            
            //TODO: Remove etagere aswell

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>