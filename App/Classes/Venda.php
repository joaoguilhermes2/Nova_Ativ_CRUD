<?php

class Venda {
    private $conn;
    private $table = "vendas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($cliente_id, $produto_id, $quantidade, $total) {
        $sql = "INSERT INTO " . $this->table . " (id_cliente, id_produto, quantidade, total) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$cliente_id, $produto_id, $quantidade, $total]);
    }

    public function read() {
        $sql = "SELECT v.id, c.nome AS cliente, p.nome AS produto, v.quantidade, v.total, v.data_venda 
                FROM " . $this->table . " v
                JOIN clientes c ON v.id_cliente = c.id
                JOIN produtos p ON v.id_produto = p.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>