<?php
include '../../App/DB/database.php';
include '../../App/Classes/Venda.php';
include '../../App/Classes/Cliente.php';
include '../../App/Classes/Produto.php';

$database = new Database();
$db = $database->connect();
$venda = new Venda($db);
$cliente = new Cliente($db);
$produto = new Produto($db);

$clientes = $cliente->read();
$produtos = $produto->read();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];
    $preco = array_filter($produtos, fn($p) => $p['id'] == $produto_id)[0]['preco'];
    $total = $quantidade * $preco;
    $venda->create($cliente_id, $produto_id, $quantidade, $total);
}
$vendas = $venda->read();
?>
<!DOCTYPE html>
<html>
<head><title>Vendas</title></head>
<link rel="stylesheet" href="../Css/estilos_construtores.css">
<body>
    <h2>Gerenciar Vendas</h2>
    <form method="POST">
        <select name="cliente_id">
            <?php foreach ($clientes as $c) { echo "<option value='{$c['id']}'>{$c['nome']}</option>"; } ?>
        </select>
        <select name="produto_id">
            <?php foreach ($produtos as $p) { echo "<option value='{$p['id']}'>{$p['nome']}</option>"; } ?>
        </select>
        <input type="number" name="quantidade" placeholder="Quantidade" required>
        <button type="submit">Registrar Venda</button>
    </form>
    <ul>
        <?php foreach ($vendas as $v) { echo "<li>{$v['cliente']} comprou {$v['quantidade']}x {$v['produto']} por R\${$v['total']} <a href='delete_venda.php?id={$v['id']}'>Excluir</a></li>"; } ?>
    </ul>
</body>
</html>