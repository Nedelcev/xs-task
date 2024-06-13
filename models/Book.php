<?php
class Book {
    private $conn;
    private $table_name = "books";

    public $id;
    public $name;
    public $isbn;
    public $description;
    public $created_at;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, isbn, description, user_id) VALUES (:name, :isbn, :description, :user_id)";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->isbn = htmlspecialchars(strip_tags($this->isbn));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, isbn = :isbn, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->isbn = htmlspecialchars(strip_tags($this->isbn));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getBookById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name = $row['name'];
            $this->isbn = $row['isbn'];
            $this->description = $row['description'];
            $this->user_id = $row['user_id'];
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
	
	public function bookExists() {
		$query = "SELECT id FROM " . $this->table_name . " WHERE isbn = :isbn LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$this->isbn = htmlspecialchars(strip_tags($this->isbn));
		$stmt->bindParam(':isbn', $this->isbn);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}
?>
