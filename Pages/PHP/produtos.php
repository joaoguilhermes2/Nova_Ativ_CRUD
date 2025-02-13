<?php
include '../../App/DB/database.php';
include '../../App/Classes/Produto.php';

$database = new Database();
$db = $database->connect();
$produto = new Produto($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $produto->create($nome, $descricao, $preco);
}
$produtos = $produto->read();
?>
<!DOCTYPE html>
<html>
<head><title>Produtos</title></head>
<body>
    <h2>Gerenciar Produtos</h2>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="descricao" placeholder="Descrição" required>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <button type="submit">Adicionar</button>
    </form>
    <ul>
        <?php foreach ($produtos as $p) { echo "<li>{$p['nome']} - {$p['descricao']} - R\${$p['preco']} <a href='delete_produto.php?id={$p['id']}'>Excluir</a></li>"; } ?>
    </ul>
</body>
</html>