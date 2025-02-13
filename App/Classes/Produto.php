<?php

class Produto {
    private $conn;
    private $table = "produtos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $descricao, $preco) {
        $sql = "INSERT INTO " . $this->table . " (nome, descricao, preco) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $descricao, $preco]);
    }

    public function read() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $descricao, $preco) {
        $sql = "UPDATE " . $this->table . " SET nome = ?, descricao = ?, preco = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $descricao, $preco, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>