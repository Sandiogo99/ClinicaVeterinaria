<?php
namespace ClinicaVeterinaria\projeto\HTML;
require_once('../DAO/Conexao.php');
require_once('../DAO/Inserir.php');

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Inserir;

$conexao = new Conexao();
$inserir = new Inserir();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    $mensagem = $inserir->cadastrarTutor($conexao, $nome, $cpf, $telefone, $email, $endereco);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilo.css">
    <title>Cadastro Tutor</title>
</head>
<body id="tutor" class="container py-4 bg-white text-dark">
    <?php // include('../COMPONENTES/cabecalho.php'); ?>
    
    <h1>Cadastro Tutor</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" href="telaTutor.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarTutor.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link" href="atualizarTutor.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirTutor.php">Excluir</a></li>
    </ul>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" id="nome" name="nome"/><br><br>

        <label>CPF:</label><br>
        <input type="text" id="cpf" name="cpf"/><br><br>

        <label>Telefone:</label><br>
        <input type="text" id="telefone" name="telefone"/><br><br>

        <label>Email:</label><br>
        <input type="email" id="email" name="email"/><br><br>

        <label>Endereço:</label><br>
        <input type="text" id="endereco" name="endereco"/><br><br>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>

    <div>
        <?php echo $mensagem; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>