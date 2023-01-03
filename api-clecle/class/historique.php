<?php
    class Historique {
        // Connection
        private $conn;

        // Table
        private $db_table = "historique";

        // Columns
        public $id_historique;
        public $id_outil;
        public $x;
        public $y;
        public $date;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllHistorique(){
            $sqlQuery = "SELECT id_historique, id_outil, x, y FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createHistorique(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_outil = :id_outil,
                        x = :x,
                        y = :y,
                        date = :date;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_outil", $this->id_outil);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            $stmt->bindParam(":date", $this->date);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ with etagere
        public function getHistoriqueFromOutil($id_outil){
            $sqlQuery = "SELECT
                        id_historique,
                        x,
                        y,
                        date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_outil = :id_outil";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_outil", $id_outil);
        
            $stmt->execute();
        
            return $stmt;
        }

        // READ single with id
        public function getHistoriqueFromId(){
            $sqlQuery = "SELECT
                        id_historique,
                        id_outil,
                        x, 
                        y,
                        date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    id_historique = :id_historique";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":id_historique", $this->id_historique);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        
            $this->id_outil = $dataRow['id_outil'];
            $this->x = $dataRow['x'];
            $this->y = $dataRow['y'];
            $this->date = $dataRow['date'];

            return $this;
        }

         // UPDATE
        public function updateHistorique(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_outil = :id_outil, 
                        x = :x,
                        y = :y,
                        date = :date
                    WHERE 
                        id_historique = :id_historique";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_historique=htmlspecialchars(strip_tags($this->id_historique));
            $this->id_outil=htmlspecialchars(strip_tags($this->id_outil));
            $this->x=htmlspecialchars(strip_tags($this->x));
            $this->y=htmlspecialchars(strip_tags($this->y));
            $this->date=htmlspecialchars(strip_tags($this->date));
        
           
            $stmt->bindParam(":id_historique", $this->id_historique);
            $stmt->bindParam(":id_outil", $this->id_outil);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            $stmt->bindParam(":date", $this->date);
            
            if($stmt->execute()){
               return true;
            }
            return false;
           
        }

        // DELETE
        public function deleteHistoriqueFromId(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_historique = :id_historique";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_historique=htmlspecialchars(strip_tags($this->id_historique));
        
            $stmt->bindParam(":id_historique", $this->id_historique);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>