<?php
require_once 'classes/Connection.php';

class Genre {
    public $id;
    public $genre;

    public function __construct() {
    }

    public function save() {
        $params = array(
            'genre' => $this->genre
        );

        if ($this->id === NULL) {
            $sql = "INSERT INTO genres(
                        genre
                    ) VALUES (
                        :genre
                    )";
        }
        else if ($this->id !== NULL) {
            $params["id"] = $this->id;

            $sql = "UPDATE genres SET
                        genre = :genre
                    WHERE id = :id";
        }

        $conn = Connection::getInstance();
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to save genre");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error saving genre");
            }
            if ($this->id === NULL) {
                $this->id = $conn->lastInsertId('genres');
            }
        }
    }

    public function delete() {
        if (empty($this->id)) {
            throw new Exception("Unsaved genre cannot be deleted");
        }
        $params = array(
            'id' => $this->id
        );
        $sql = 'DELETE FROM genres WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to delete genre");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error deleting genre");
            }
        }
    }

    public static function all() {
        $sql = 'SELECT * FROM genres ORDER BY genre';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve genres");
        }
        else {
            $genres = $stmt->fetchAll(PDO::FETCH_CLASS, 'Genre');
            return $genres;
        }
    }

    public static function find($id) {
        $params = array(
            'id' => $id
        );
        $sql = 'SELECT * FROM genres WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve genre");
        }
        else {
            $genre = $stmt->fetchObject('Genre');
            return $genre;
        }
    }
}
?>
