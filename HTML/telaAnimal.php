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
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = (int)$_POST['idade'];
    $codigoTutor = (int)$_POST['codigoTutor'];

    $mensagem = $inserir->cadastrarAnimal($conexao, $nome, $especie, $raca, $idade, $codigoTutor);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro Animal</title>
</head>
<body class="container py-4 bg-white text-dark">
    <?php include('../COMPONENTES/cabecalho.php'); ?>
    
    <h1>Cadastro Animal</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" href="telaAnimal.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarAnimal.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link" href="atualizarAnimal.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirAnimal.php">Excluir</a></li>
    </ul>

    <form method="POST">
        <label>Nome do Pet:</label><br>
        <input type="text" id="nome" name="nome"/><br><br>

        <label>Espécie:</label><br>
        <input type="text" id="especie" name="especie"/><br><br>

        <label>Raça:</label><br>
        <input type="text" id="raca" name="raca"/><br><br>

        <label>Idade:</label><br>
        <input type="number" id="idade" name="idade"/><br><br>

        <label>Código do Tutor:</label><br>
        <input type="number" id="codigoTutor" name="codigoTutor"/><br><br>

        <button type="submit" class="btn btn-warning">Cadastrar</button>
    </form>

    <div>
        <?php echo $mensagem; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>