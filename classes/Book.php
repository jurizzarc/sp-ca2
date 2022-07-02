<?php
require_once 'classes/Connection.php';

class Book {
    public $id;
    public $title;
    public $genre_id;
    public $description;
    public $format;
    public $pages;
    public $isbn;
    public $year;
    public $price;
    public $cover;
    public $imprint;
    public $publisher_id;

    public function __construct() {
    }

    public function save() {
        $params = array(
            'title' => $this->title,
            'genre_id' => $this->genre_id,
            'description' => $this->description,
            'format' => $this->format,
            'pages' => $this->pages,
            'isbn' => $this->isbn,
            'year' => $this->year,
            'price' => $this->price,
            'cover' => $this->cover,
            'imprint' => $this->imprint,
            'publisher_id' => $this->publisher_id
        );

        if ($this->id === NULL) {
            $sql = "INSERT INTO books(
                        title, genre_id, description, format, pages, isbn, year, price, cover, imprint, publisher_id
                    ) VALUES (
                        :title, :genre_id, :description, :format, :pages, :isbn, :year, :price, :cover, :imprint, :publisher_id
                    )";
        }
        else if ($this->id !== NULL) {
            $params["id"] = $this->id;

            $sql = "UPDATE books SET
                        title = :title,
                        genre_id = :genre_id,
                        description = :description,
                        format = :format,
                        pages = :pages,
                        isbn = :isbn,
                        year = :year,
                        price = :price,
                        cover = :cover,
                        imprint = :imprint,
                        publisher_id = :publisher_id
                    WHERE id = :id";
        }

        $conn = Connection::getInstance();
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute($params);             
        
        if (!$success) {
            throw new Exception("Failed to save book");
        }
        else {
            $rowCount = $stmt->rowCount();
            if ($rowCount !== 1) {
                throw new Exception("Error saving book");
            }
            if ($this->id === NULL) {
                $this->id = $conn->lastInsertId('books');
            }
        }
    }

    public function delete() {
        if (empty($this->id)) {
            throw new Exception("Unsaved book cannot be deleted");
        }
        $connection = Connection::getInstance();
        $params = array(
            'book_id' => $this->id
        );
        $sql = 'DELETE FROM book_author WHERE book_id = :book_id';
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to delete book authors");
        }
        else {
            $sql = 'DELETE FROM books WHERE id = :book_id';
            $connection = Connection::getInstance();
            $stmt = $connection->prepare($sql);
            $success = $stmt->execute($params);
            if (!$success) {
                throw new Exception("Failed to delete book");
            }
            else {
                $rowCount = $stmt->rowCount();
                if ($rowCount !== 1) {
                    throw new Exception("Error deleting book");
                }
            }
        }
    }
    
    public function setAuthors($authorIds) {
        $connection = Connection::getInstance();
        $params = array(
            'book_id' => $this->id
        );
        $sql = 'DELETE FROM book_author WHERE book_id = :book_id';
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to delete book authors");
        }
        else {
            $sql = "INSERT INTO book_author (
                        book_id, author_id
                    ) VALUES (
                        :book_id, :author_id
                    );";
            $stmt = $connection->prepare($sql);
            foreach ($authorIds as $authorId) {
                $params['author_id'] = $authorId;
                $success = $stmt->execute($params);
                if (!$success) {
                    throw new Exception("Failed to store book author");
                }
            }
        }
    }

    public static function all() {
        $sql = 'SELECT * FROM books';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve books");
        }
        else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }

    public static function find($id) {
        $params = array(
            'id' => $id
        );
        $sql = 'SELECT * FROM books WHERE id = :id';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve book");
        }
        else {
            $book = $stmt->fetchObject('Book');
            return $book;
        }
    }
    
    //find books that have a specific genre
    public static function findByGenreId($genreId) {
        $params = array(
            'genre_id' => $genreId
        );
        $sql = "SELECT DISTINCT ba.book_id FROM book_author ba LEFT JOIN books b ON ba.book_id = b.id LEFT JOIN genres g ON b.genre_id = g.id WHERE b.genre_id = :genre_id";

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve books");
        }
        else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }
    
    //find books that are written by a specific author
    public static function findByAuthorId($authorId) {
        $params = array(
            'author_id' => $authorId
        );
        $sql = "SELECT b.* FROM books b LEFT JOIN book_author ba ON b.id = ba.book_id LEFT JOIN authors a ON ba.author_id = a.id WHERE a.id = :author_id";
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!success) {
            throw new Exception("Failed to retrieve books");
        } else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }
    
    //find books that were published by a specific publisher
    public static function findByPublisherId($publisherId) {
        $params = array(
            'publisher_id' => $publisherId
        );
        $sql = "SELECT b.* FROM books b LEFT JOIN publishers p ON b.publisher_id = p.id WHERE p.id = :publisher_id";
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!success) {
            throw new Exception("Failed to retrieve books");
        } else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }
    
    //find books that have the same genre as the genre of a book and don't have the id of that book
    public static function recommendationsByGenreId($genreId, $bookId) {
        $params = array(
            'genre_id' => $genreId,
            'id' => $bookId
        );
        $sql = "SELECT DISTINCT ba.book_id FROM book_author ba LEFT JOIN books b ON ba.book_id = b.id LEFT JOIN genres g ON b.genre_id = g.id WHERE b.genre_id = :genre_id AND b.id != :id LIMIT 6";

        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);
        if (!$success) {
            throw new Exception("Failed to retrieve books");
        }
        else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }
    
    //select 12 books that were only released in 2019
    public static function newBookReleases() {
        $sql = 'SELECT * FROM books WHERE year = 2019 LIMIT 12';
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve books");
        }
        else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }
    
    //select books from the "Penguin English Library"
    //since there's no table for "series", I put the "Penguin English Library" in the synopsis of some books
    //so these books would be found from the books table and displayed in the index page
    public static function PELibraryBooks() {
        $sql = "SELECT * FROM books WHERE description LIKE '%Penguin English Library%'";
        $connection = Connection::getInstance();
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception("Failed to retrieve books");
        }
        else {
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
            return $books;
        }
    }
}
?>
