<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $active;
    public $is_admin;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getUserByEmail() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email AND deleted = 0 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->active = $row['active'];
            $this->is_admin = $row['is_admin'];
            return true;
        }
        return false;
    }

    public function getUserById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id AND deleted = 0 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->active = $row['active'];
            $this->is_admin = $row['is_admin'];
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET first_name = :first_name, last_name = :last_name" . (isset($this->password) ? ", password = :password" : "") . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":id", $this->id);

        if (isset($this->password)) {
            $stmt->bindParam(":password", $this->password);
        }

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAllInactiveUsers() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE active = 0 AND deleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE active = 1 AND deleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function activateUser() {
        $query = "UPDATE " . $this->table_name . " SET active = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteUser() {
        $query = "UPDATE " . $this->table_name . " SET deleted = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function promoteUserToAdmin() {
        $query = "UPDATE " . $this->table_name . " SET is_admin = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
	
	public function emailExists() {
		$query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$this->email = htmlspecialchars(strip_tags($this->email));
		$stmt->bindParam(':email', $this->email);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}

}
?>
