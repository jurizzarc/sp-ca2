<?php
require_once 'classes/Connection.php';

class Author {
    public $id;
    public $last_name;
    public $first_name;
    public $about;

    public function __construct() {
    }

    public function save() {
        $params = array(
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'about' => $this->about
        );

        if ($this->id === NULL) {
            $sql = "INSERT INTO authors(
                        last_name, first_name, about
                    ) VALUES (
                        :last_name, :first_name, :about
                    )";
        }
        else if ($this->id !== NULL) {
            $params["id"] = $this->id;

            $sql = "UPDATE authors SET
                        last_name = :last_name,
                        first_name = :first_name,
                        about = :about
                    WHERE id = :id";
        }

        $conn = Connection::getInstance();
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to save author");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error saving author");
            }
            if ($this->id === NULL) {
                $this->id = $conn->lastInsertId('authors');
            }
        }
    }

    public function delete() {
        if (empty($this->id)) {
            throw new Exception("Unsaved author cannot be deleted");
        }
        $params = array(
            'id' => $this->id
        );
        $sql = 'DELETE FROM authors WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to delete author");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error deleting author");
            }
        }
    }

    //select all authors, sort by last name
    public static function all() {
        $sql = 'SELECT * FROM authors ORDER BY last_name';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve authors");
        }
        else {
            $authors = $stmt->fetchAll(PDO::FETCH_CLASS, 'Author');
            return $authors;
        }
    }
    
    //select authors by the first letter of their last name
    public static function selectByLastName($letter) {
        $sql = "SELECT * FROM authors WHERE last_name LIKE '{$letter}%' ORDER BY last_name";
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve authors");
        }
        else {
            $authors = $stmt->fetchAll(PDO::FETCH_CLASS, 'Author');
            return $authors;
        }
    }

    public static function find($id) {
        $params = array(
            'id' => $id
        );
        $sql = 'SELECT * FROM authors WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve author");
        }
        else {
            $author = $stmt->fetchObject('Author');
            return $author;
        }
    }
    
    //find author(s) who wrote a specific book
    public static function findByBookId($bookId) {
        $params = array(
            'id' => $bookId
        );
        $sql = "SELECT a.*
                FROM authors a
                LEFT JOIN book_author ba ON a.id = ba.author_id
                LEFT JOIN books b ON ba.book_id = b.id
                WHERE b.id = :id";

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve authors");
        }
        else {
            $authors = $stmt->fetchAll(PDO::FETCH_CLASS, 'Author');
            return $authors;
        }
    }
    
}
?>
