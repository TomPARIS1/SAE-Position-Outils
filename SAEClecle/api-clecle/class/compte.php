<?php
    class Compte {
        // Connection
        private $conn;

        // Table
        private $db_table = "compte";

        // Columns
        public $id;
        public $nom;
        public $mdp;
        public $niveau;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllCompte(){
            $sqlQuery = "SELECT id, nom, mdp, niveau FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCompte(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nom = :nom,
                        mdp = :mdp,
                        niveau = :niveau;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":mdp", $this->mdp);
            $stmt->bindParam(":niveau", $this->niveau);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function findCompteByName()
        {
            $sqlQuery = "SELECT
                        id,
                        mdp,
                        niveau
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        nom = :nom";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dataRow==null)
            {
                return null;
            }

            $this->id = $dataRow['id'];
            $this->mdp = $dataRow['mdp'];
            $this->niveau = $dataRow['niveau'];
            return $this;
        }

        // READ single with id
        public function getCompteFromId(){
            $sqlQuery = "SELECT
                        nom,
                        mdp,
                        niveau
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id = :id";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        
            $this->nom = $dataRow['nom'];
            $this->mdp = $dataRow['mdp'];
            $this->niveau = $dataRow['niveau'];

            return $this;
        }

         // UPDATE
        public function updateCompte(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nom = :nom,
                        mdp = :mdp,
                        niveau = :niveau
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->mdp=htmlspecialchars(strip_tags($this->mdp));
            $this->niveau=htmlspecialchars(strip_tags($this->niveau));
        
           
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":mdp", $this->mdp);
            $stmt->bindParam(":niveau", $this->niveau);
            
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
            
            //TODO: Remove etagere aswell

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>