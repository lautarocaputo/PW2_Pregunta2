<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if(!$this->conn) {
            Logger::error("Error al ingresar a la base de datos con: $servername, $username, $password, $dbname");
            exit();
        }

        mysqli_set_charset($this->conn, "utf8");

    }

    public function __destruct() {
        mysqli_close($this->conn);
    }

    public function query($sql) {
        Logger::info("Ejecutando Query $sql ");
        $result = mysqli_query($this->conn, $sql);

        if (!is_bool($result))
            return mysqli_fetch_all($result, MYSQLI_BOTH);
        else
            return [];
    }

    public function insert($sql) {
        return mysqli_query($this->conn, $sql);
    }

    public function update($sql){
        return mysqli_query($this->conn, $sql);
    }

    public function delete($sql){
        return mysqli_query($this->conn, $sql);
    }

    public function escape($string) {
        return mysqli_real_escape_string($this->conn, $string);
    }

    public function lastError() {
        return mysqli_error($this->conn);
    }

    public function begin_transaction() {
        mysqli_begin_transaction($this->conn);
    }

    public function commit() {
        mysqli_commit($this->conn);
    }

    public function rollback() {
        mysqli_rollback($this->conn);
    }

    public function prepare($sql) {
        return mysqli_prepare($this->conn, $sql);
    }

    public function bind_param($stmt, $types, ...$params) {
        return mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    public function execute($stmt) {
        return mysqli_stmt_execute($stmt);
    }

    public function get_result($stmt) {
        return mysqli_stmt_get_result($stmt);
    }
}
