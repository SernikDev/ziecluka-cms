<?php

class Database {

    /**
     * Connection to database
     * Globals are defined in config/define.php
     * @return boolean
     */
    public function connect() {
        try {
            if (!isset($this->connection)) {
                $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
            }
            return $this->connection;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Closing database connection
     */
    public function __destruct() {
        $this->connection = null;
    }

    /**
     * Main database query for SELECT
     * @param string $sql - sql query
     * @param mixed $array - parameters to bind
     * @param constant $fetchmode - PDO fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchmode = PDO::FETCH_ASSOC) {
        $pdo = $this->connect()->prepare($sql);

        foreach ($array as $key => $value) {
            $pdo->bindValue("$key", $value);
        }

        $pdo->execute();
        return $pdo->fetchAll($fetchmode);
    }

    /**
     * Main database query for INSERT
     * @param string $sql - sql query
     * @param mixed $array - parameters to bind
     */
    public function insert($sql, $array = array()) {

        $pdo = $this->connect()->prepare($sql);

        foreach ($array as $key => $value) {
            $pdo->bindValue("$key", $value);
        }

        $pdo->execute();
    }

    /**
     * Main database query for UPDATE
     * @param string $sql - sql query
     * @param mixed $array - parameters to bind
     */
    public function update($sql, $array = array()) {

        $pdo = $this->connect()->prepare($sql);

        foreach ($array as $key => $value) {
            $pdo->bindValue("$key", $value);
        }

        $pdo->execute();
    }

    /**
     * Main database query for DELETE
     * @param string $sql - sql query
     * @param mixed $array - parameters to bind
     */
    public function delete($sql, $array = array()) {

        $pdo = $this->connect()->prepare($sql);

        foreach ($array as $key => $value) {
            $pdo->bindValue("$key", $value);
        }

        $pdo->execute();
    }

    public function numRows($sql, $array = array()) {
        $pdo = $this->connect()->prepare($sql);

        foreach ($array as $key => $value) {
            $pdo->bindValue("$key", $value);
        }

        $pdo->execute();

        return $pdo;
    }

}
