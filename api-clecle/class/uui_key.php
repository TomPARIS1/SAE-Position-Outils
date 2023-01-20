<?php
    include_once '../../class/compte.php';

    class UUI_key {
        // Connection
        private $conn;

        // Table
        private $db_table = "user_key";

        // Columns
        public $UUID;
        public $id_compte;
        public $date_valide;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }


        // Function take on internet because we don't know how to generate uuid
        function guidv4($data = null) {
            // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
            $data = openssl_random_pseudo_bytes(16);
            assert(strlen($data) == 16);
        
            // Set version to 0100
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        
            // Output the 36 character UUID.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // CREATE
        public function createUUID(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        UUID = :UUID,
                        id_compte = :id_compte,
                        date_valide = :date_valide;";
        
            $stmt = $this->conn->prepare($sqlQuery);

            $this->UUID = $this->guidv4();

            date_default_timezone_set('Europe/Paris');
            $this->date_valide = date("Y-m-d H:i:s");
            // bind data
            $stmt->bindParam(":UUID", $this->UUID);
            $stmt->bindParam(":id_compte", $this->id_compte);
            $stmt->bindParam(":date_valide", $this->date_valide);
            
            if($stmt->execute()){
               return $this;
            }
            return null;
        }

        public function getIdClientFromUUID()
        {
            $sqlQuery = "SELECT
                        id_compte,
                        date_valide
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        UUID = :UUID";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":UUID", $this->UUID);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            date_default_timezone_set('Europe/Paris');
            $this->id_compte = $dataRow['id_compte'];
            $this->date_valide = $dataRow['date_valide'];

            return $this;
        }

        public function checkUUID()
        {
            $item = new Compte($this->conn);
            $item->id = $this->getIdClientFromUUID()->id_compte;
            
            $item->getCompteFromId();


            date_default_timezone_set('Europe/Paris');
            $today_time = strtotime(date("Y-m-d H:i:s"));
            $expiration_date = strtotime(date("Y-m-d H:i:s", strtotime($this->date_valide. ' + 2 days')));

            if ($expiration_date < $today_time) 
            {
                $this->deleteUUIDFromUUID();
                $item->id = null;
                return $item;
            }

            return $item;
        }

        public function IsValidUUID()
        {
            return $this->checkUUID()->id;
        }

        // DELETE
        public function deleteUUIDFromUUID(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE UUID = :UUID";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $stmt->bindParam(":UUID", $this->UUID);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>