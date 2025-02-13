<?php
include '../../App/DB/database.php';
include '../../App/Classes/Cliente.php';

$database = new Database();
$db = $database->connect();
$cliente = new Cliente($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cliente->create($nome, $email, $telefone);
}
$clientes = $cliente->read();
?>
<!DOCTYPE html>
<html>
<head><title>Clientes</title></head>
<body>
    <h2>Gerenciar Clientes</h2>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <button type="submit">Adicionar</button>
    </form>
    <ul>
        <?php foreach ($clientes as $c) { echo "<li>{$c['nome']} - {$c['email']} - {$c['telefone']} <a href='delete_cliente.php?id={$c['id']}'>Excluir</a></li>"; } ?>
    </ul>
</body>
</html>