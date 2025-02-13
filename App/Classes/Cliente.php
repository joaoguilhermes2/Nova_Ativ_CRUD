<?php

class Cliente {
    private $conn;
    private $table = "clientes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $email, $telefone) {
        $sql = "INSERT INTO " . $this->table . " (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone]);
    }

    public function read() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $email, $telefone) {
        $sql = "UPDATE " . $this->table . " SET nome = ?, email = ?, telefone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>