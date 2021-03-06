<?php
class Connection {

    private static $host = "localhost";
    private static $database = "bookstore";
    private static $username = "root";
    //MAMP
    private static $password = "root"; 
    //XAMPP
    //private static $password = "";

    public static function getInstance() {
        $dsn = 'mysql:host=' . Connection::$host . ';dbname=' . Connection::$database;

        $connection = new PDO($dsn, Connection::$username, Connection::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

}
