<?php
    include_once '../../class/compte.php';

    class SAV {
        // Connection
        private $conn;

        // Table
        private $db_table = "sav";

        // Columns
        public $id_sav;
        public $id_compte;
        public $nom;
        public $issue;
        public $commentaire;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // CREATE
        public function createSavTicket(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_compte = :id_compte,
                        nom = :nom,
                        issue = :issue,
                        commentaire = :commentaire;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id_compte", $this->id_compte);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":issue", $this->issue);
            $stmt->bindParam(":commentaire", $this->commentaire);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>