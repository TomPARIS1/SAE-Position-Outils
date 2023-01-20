<?php
    class Outil {
        // Connection
        private $conn;

        // Table
        private $db_table = "outil";

        // Columns
        public $id;
        public $id_etagere;
        public $type;
        public $nbr_utilisations;
        public $x;
        public $y;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllOutil(){
            $sqlQuery = "SELECT id, id_etagere, type, nbr_utilisations, x, y FROM " . $this->db_table . " ORDER BY nbr_utilisations";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createOutil(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_etagere = :id_etagere, 
                        type = :type, 
                        nbr_utilisations = :nbr_utilisations,
                        x = :x,
                        y = :y";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_etagere", $this->id_etagere);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":nbr_utilisations", $this->nbr_utilisations);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ with etagere
        public function getOutilsFromEtagere($etagere_id){
            $sqlQuery = "SELECT
                        id,
                        id_etagere,
                        type, 
                        nbr_utilisations, 
                        x, 
                        y
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id_etagere = :id_etagere";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_etagere", $etagere_id);
        
            $stmt->execute();
        
            return $stmt;
        }

        // READ with atelier
        public function getOutilsFromAtelierUseOrder($id_atelier){
            $sqlQuery = "SELECT
                        outil.id,
                        id_etagere,
                        type, 
                        nbr_utilisations, 
                        outil.x, 
                        outil.y
                        FROM
                        ". $this->db_table ."
                        JOIN etagere ON etagere.id = outil.id_etagere
                        JOIN atelier ON atelier.id_atelier = etagere.id_atelier
                        WHERE 
                            atelier.id_atelier = :id_atelier
                        ORDER BY nbr_utilisations";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_atelier", $id_atelier);
        
            $stmt->execute();
        
            return $stmt;
        }

        public function getOutilsFromAtelierReservationOrder($id_atelier){
            $sqlQuery = "SELECT
                        outil.id,
                        id_etagere,
                        type, 
                        nbr_utilisations, 
                        outil.x, 
                        outil.y
                        FROM
                        ". $this->db_table ."
                        JOIN etagere ON etagere.id = outil.id_etagere
                        JOIN atelier ON atelier.id_atelier = etagere.id_atelier
                        WHERE 
                            atelier.id_atelier = :id_atelier
                        ORDER BY type";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_atelier", $id_atelier);
        
            $stmt->execute();
        
            return $stmt;
        }

        public function getOutilsFromAtelierForReservation($id_atelier){
            $sqlQuery = "SELECT
                        outil.id,
                        id_etagere,
                        type, 
                        nbr_utilisations, 
                        outil.x, 
                        outil.y
                        FROM
                        ". $this->db_table ."
                        JOIN etagere ON etagere.id = outil.id_etagere
                        JOIN atelier ON atelier.id_atelier = etagere.id_atelier
                        WHERE 
                            atelier.id_atelier = :id_atelier
                        ORDER BY type";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_atelier", $id_atelier);
        
            $stmt->execute();
        
            return $stmt;
        }

        // READ with atelier
        public function getOutilsFromCompte($id_compte){
            $sqlQuery = "SELECT
                        outil.id,
                        id_etagere,
                        type, 
                        nbr_utilisations, 
                        outil.x, 
                        outil.y
                        FROM
                        ". $this->db_table ."
                        JOIN etagere ON etagere.id = outil.id_etagere
                        JOIN atelier ON atelier.id_atelier = etagere.id_atelier
                        WHERE 
                            atelier.id_compte = :id_compte
                        ORDER BY nbr_utilisations";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":id_compte", $id_compte);
        
            $stmt->execute();
        
            return $stmt;
        }
        
        // READ single with id
        public function getOutilsFromId(){
            $sqlQuery = "SELECT
                        id,
                        id_etagere,
                        type, 
                        nbr_utilisations, 
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

        
            $this->id_etagere = $dataRow['id_etagere'];
            $this->type = $dataRow['type'];
            $this->nbr_utilisations = $dataRow['nbr_utilisations'];
            $this->x = $dataRow['x'];
            $this->y = $dataRow['y'];

            return $this;
        }
        
        // UPDATE
        public function updateOutil(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_etagere = :id_etagere, 
                        type = :type, 
                        nbr_utilisations = :nbr_utilisations, 
                        x = :x,
                        y = :y
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_etagere=htmlspecialchars(strip_tags($this->id_etagere));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->nbr_utilisations=htmlspecialchars(strip_tags($this->nbr_utilisations));
            $this->x=htmlspecialchars(strip_tags($this->x));
            $this->y=htmlspecialchars(strip_tags($this->y));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
           
            $stmt->bindParam(":id_etagere", $this->id_etagere);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":nbr_utilisations", $this->nbr_utilisations);
            $stmt->bindParam(":x", $this->x);
            $stmt->bindParam(":y", $this->y);
            $stmt->bindParam(":id", $this->id);
            if($stmt->execute()){
               return true;
            }
            return false;
           
        }

        // DELETE
        public function deleteOutilFromId(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(":id", $this->id);
            
            //TODO: Remove historique and reservation aswell

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>