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
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $endereco = trim($_POST['endereco']);
    $cpfNumerico = preg_replace('/\D/', '', $cpf);

    if ($nome === '' || $cpf === '' || $telefone === '' || $email === '' || $endereco === '') {
        $mensagem = 'Preencha todos os campos.';
    } elseif (strlen($cpfNumerico) !== 11) {
        $mensagem = 'Informe um CPF válido com 11 dígitos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = 'Informe um endereço de e-mail válido.';
    } else {
        $mensagem = $inserir->cadastrarTutor($conexao, $nome, $cpfNumerico, $telefone, $email, $endereco);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilo1.css">
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
        <label for="nome" class="form-label text-white">Nome:</label><br>
        <input type="text" id="nome" name="nome" class="form-control" maxlength="250" required/><br><br>

        <label for="cpf" class="form-label text-white">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" class="form-control" maxlength="14" pattern="[0-9.\-]{11,14}" required/><br><br>

        <label for="telefone" class="form-label text-white">Telefone:</label><br>
        <input type="tel" id="telefone" name="telefone" class="form-control" maxlength="20" required/><br><br>

        <label for="email" class="form-label text-white">Email:</label><br>
        <input type="email" id="email" name="email" class="form-control" maxlength="150" required/><br><br>

        <label for="endereco" class="form-label text-white">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" class="form-control" maxlength="300" required/><br><br>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>

    <div>
        <?php echo $mensagem; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>