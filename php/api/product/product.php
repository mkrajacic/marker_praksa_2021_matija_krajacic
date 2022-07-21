<?php
    class Product {
        private $conn;
        private $table = "product";

        public $id;
        public $name;
        public $brand_id;
        public $description;
        public $price_base;
        public $discount;
        public $price_final;
        public $available;
        public $forbidden;
        public $special;
        public $active;

        // public function construct($db) {
        //     $this->conn = $db;
        // }

        function read(PDO $con) {
            $query = "SELECT p.id, p.name, p.description, p.price_base, p.discount, p.price_final, p.available, p.forbidden, p.special, p.active FROM " . $this->table . " p ORDER BY p.id";
            
            $stmt = $con->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function create(PDO $con) {
            $query = "INSERT INTO " . $this->table . " (name,brand_id,description,price_base,discount,price_final,available,forbidden,special,active) VALUES (?,?,?,?,?,?,?,?,?,?)";

            $stmt = $con->prepare($query);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->brand_id=htmlspecialchars(strip_tags($this->brand_id));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->price_base=htmlspecialchars(strip_tags($this->price_base));
            $this->discount=htmlspecialchars(strip_tags($this->discount));
            $this->price_final=htmlspecialchars(strip_tags($this->price_final));
            $this->available=htmlspecialchars(strip_tags($this->available));
            $this->forbidden=htmlspecialchars(strip_tags($this->forbidden));
            $this->special=htmlspecialchars(strip_tags($this->special));
            $this->active=htmlspecialchars(strip_tags($this->active));

            $stmt->bindParam(1, $this->name);
            $stmt->bindParam(2, $this->brand_id);
            $stmt->bindParam(3, $this->description);
            $stmt->bindParam(4, $this->price_base);
            $stmt->bindParam(5, $this->discount);
            $stmt->bindParam(6, $this->price_final);
            $stmt->bindParam(7, $this->available);
            $stmt->bindParam(8, $this->forbidden);
            $stmt->bindParam(9, $this->special);
            $stmt->bindParam(10, $this->active);

            if($stmt->execute()) {
                return true;
            }
            return false;
        }

        function update(PDO $con) {

            $this->id=htmlspecialchars(strip_tags($this->id));

            $check_query = "SELECT p.id FROM " . $this->table . " p WHERE id=?";
            $check = $con->prepare($check_query);
            $check->bindParam(1, $this->id);

            if($check->execute()) {
                if($check->rowCount()>0) {
                    $query = "UPDATE " . $this->table . " SET name=?,brand_id=?,description=?,price_base=?,discount=?,price_final=?,available=?,forbidden=?,special=?,active=? WHERE id=?";

                    $stmt = $con->prepare($query);
        
                    $this->name=htmlspecialchars(strip_tags($this->name));
                    $this->brand_id=htmlspecialchars(strip_tags($this->brand_id));
                    $this->description=htmlspecialchars(strip_tags($this->description));
                    $this->price_base=htmlspecialchars(strip_tags($this->price_base));
                    $this->discount=htmlspecialchars(strip_tags($this->discount));
                    $this->price_final=htmlspecialchars(strip_tags($this->price_final));
                    $this->available=htmlspecialchars(strip_tags($this->available));
                    $this->forbidden=htmlspecialchars(strip_tags($this->forbidden));
                    $this->special=htmlspecialchars(strip_tags($this->special));
                    $this->active=htmlspecialchars(strip_tags($this->active));
        
                    $stmt->bindParam(1, $this->name);
                    $stmt->bindParam(2, $this->brand_id);
                    $stmt->bindParam(3, $this->description);
                    $stmt->bindParam(4, $this->price_base);
                    $stmt->bindParam(5, $this->discount);
                    $stmt->bindParam(6, $this->price_final);
                    $stmt->bindParam(7, $this->available);
                    $stmt->bindParam(8, $this->forbidden);
                    $stmt->bindParam(9, $this->special);
                    $stmt->bindParam(10, $this->active);
                    $stmt->bindParam(11, $this->id);
        
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
