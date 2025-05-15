<?php

class  crud{
    private $host;
    private $user;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $user, $password, $database){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql){
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return true;
        } elseif ($result) {
            return $result;
        } else {
            die("Error: " . $this->conn->error);
        }
    }

    // public function insert($table, $data){
    //     $columns = implode(", ", array_keys($data));
    //     $values = implode(", ", array_map(function ($item) {
    //         return "'" . $this->conn->real_escape_string($item) . "'";
    //     }, array_values($data)));

    //     $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    //     return $this->query($sql);
    // }
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function ($item) {
            return is_null($item) ? "NULL" : "'" . $this->conn->real_escape_string($item) . "'";
        }, array_values($data)));
    
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    
        // Logging SQL ke file debug
        file_put_contents("insert_debug.log", "SQL: $sql\n", FILE_APPEND);
    
        return $this->query($sql);
    }
    public function beginTransaction() {
        $this->conn->begin_transaction();
    }
    
    public function commit() {
        $this->conn->commit();
    }
    
    public function rollback() {
        $this->conn->rollback();
    }
        
    public function update($table, $data, $condition){
        $set = implode(", ", array_map(function ($key, $value) {
            return "$key = '" . $this->conn->real_escape_string($value) . "'";
        }, array_keys($data), $data));

        $sql = "UPDATE $table SET $set WHERE $condition";
        return $this->query($sql);
    }

    public function delete($table, $condition){
        $sql = "DELETE FROM $table WHERE $condition";
        return $this->query($sql);
    }

    public function fetchAll($result){
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Tambahkan metode escape_string
    public function escape_string($value) {
        return $this->conn->real_escape_string($value);
    }
    public function getLastInsertId() {
        return $this->conn->insert_id;
    }
    

    public function __destruct(){
        $this->conn->close();
    }
}
// Example Usage
// $db = new Database('localhost', 'username', 'password', 'database_name');
// Insert Example:
// $db->insert('table_name', ['column1' => 'value1', 'column2' => 'value2']);

// Update Example:
// $db->update('table_name', ['column1' => 'new_value'], 'id = 1');

// Delete Example:
// $db->delete('table_name', 'id = 1');

// Select Example:
// $result = $db->query('SELECT * FROM table_name');
// $rows = $db->fetchAll($result);
// print_r($rows);