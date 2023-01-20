<?php
    class Etagere {
        // Connection
        private $conn;

        // Table
        private $db_table = "etagere";

        // Columns
        public $id;
        public $id_atelier;
        public $x;
        public $y;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllEtagere(){
            $sqlQuery = "SELECT id, id_atelier, x, y FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEtagere(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_atelier = :id_atelier,
                        x = :x,
                        y = :y";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_atelier", $this->id_atelier);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ with etagere
        public function getEtagereFromAtelier($id_atelier){
            $sqlQuery = "SELECT
                        id,
                        id_atelier,
                        x, 
                        y
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_atelier = :id_atelier";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_atelier", $id_atelier);
        
            $stmt->execute();
        
            return $stmt;
        }
        
        // READ single with id
        public function getEtagereFromId(){
            $sqlQuery = "SELECT
                        id,
                        id_atelier,
                        x, 
                        y
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id = :id";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        
            $this->id_atelier = $dataRow['id_atelier'];
            $this->x = $dataRow['x'];
            $this->y = $dataRow['y'];

            return $this;
        }
        
        // UPDATE
        public function updateEtagere(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_atelier = :id_atelier, 
                        x = :x,
                        y = :y
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_atelier=htmlspecialchars(strip_tags($this->id_atelier));
            $this->x=htmlspecialchars(strip_tags($this->x));
            $this->y=htmlspecialchars(strip_tags($this->y));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
           
            $stmt->bindParam(":id_atelier", $this->id_atelier);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            $stmt->bindParam(":id", $this->id);
            if($stmt->execute()){
               return true;
            }
            return false;
           
        }

        // DELETE
        public function deleteEtagereFromId(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(":id", $this->id);
            
            //TODO: Remove outil aswell

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>