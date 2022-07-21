<?php
    class Order {
        private $conn;
        private $table = "orders";

        public $id;
        public $name;
        public $surname;
        public $address;
        public $email;
        public $time_created;
        public $status;

        // public function construct($db) {
        //     $this->conn = $db;
        // }

        function read(PDO $con) {
            $query = "SELECT o.id,o.name,o.surname,o.address,o.email,o.time_created,o.status FROM " . $this->table . " o ORDER BY o.id";
            
            $stmt = $con->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function create(PDO $con) {
            $query = "INSERT INTO " . $this->table . " (name,surname,address,email,status) VALUES (?,?,?,?,?)";

            $stmt = $con->prepare($query);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->status=htmlspecialchars(strip_tags($this->status));

            $stmt->bindParam(1, $this->name);
            $stmt->bindParam(2, $this->surname);
            $stmt->bindParam(3, $this->address);
            $stmt->bindParam(4, $this->email);
            $stmt->bindParam(5, $this->status);

            if($stmt->execute()) {
                return true;
            }
            return false;
        }

        function update(PDO $con) {
            $deleted = 0;
            $this->id=htmlspecialchars(strip_tags($this->id));

            $products_query = "DELETE FROM product_order WHERE order_id=?";
            $delete_products = $con->prepare($products_query);
            $delete_products->bindParam(1, $this->id);

            if($delete_products->execute()) {
                $deleted = 1;
            }

            $check_query = "SELECT p.id FROM " . $this->table . " p WHERE id=?";
            $check = $con->prepare($check_query);
            $check->bindParam(1, $this->id);

            if($check->execute()) {
                if($check->rowCount()>0) {
                    $query = "UPDATE " . $this->table . " SET name=?,surname=?,address=?,email=?,status=? WHERE id=?";

                    $stmt = $con->prepare($query);
        
                    $this->name=htmlspecialchars(strip_tags($this->name));
                    $this->surname=htmlspecialchars(strip_tags($this->surname));
                    $this->address=htmlspecialchars(strip_tags($this->address));
                    $this->email=htmlspecialchars(strip_tags($this->email));
                    $this->status=htmlspecialchars(strip_tags($this->status));
        
                    $stmt->bindParam(1, $this->name);
                    $stmt->bindParam(2, $this->surname);
                    $stmt->bindParam(3, $this->address);
                    $stmt->bindParam(4, $this->email);
                    $stmt->bindParam(5, $this->status);
                    $stmt->bindParam(6, $this->id);
        
                    if($stmt->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }

        function delete(PDO $con) {

            $this->id=htmlspecialchars(strip_tags($this->id));

            if(!is_numeric($this->id)) {
                return false;
            }

            $check_query = "SELECT p.id FROM " . $this->table . " p WHERE id=?";
            $check = $con->prepare($check_query);
            $check->bindParam(1, $this->id);

            if($check->execute()) {
                if($check->rowCount()>0) {
                    $query = "DELETE FROM " . $this->table . " WHERE id=?";

                    $stmt = $con->prepare($query);
        
                    $this->id=htmlspecialchars(strip_tags($this->id));
        
                    $stmt->bindParam(1, $this->id);
        
                    if($stmt->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }


    }
?>