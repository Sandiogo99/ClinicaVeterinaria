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
    $especie = trim($_POST['especie']);
    $raca = trim($_POST['raca']);
    $idade = filter_var($_POST['idade'] ?? '', FILTER_VALIDATE_INT);
    $codigoTutor = filter_var($_POST['codigoTutor'] ?? '', FILTER_VALIDATE_INT);

    if ($nome === '' || $especie === '' || $raca === '' || $idade === false || $codigoTutor === false) {
        $mensagem = 'Preencha todos os campos com valores válidos.';
    } elseif ($idade < 0) {
        $mensagem = 'A idade não pode ser negativa.';
    } elseif ($codigoTutor < 1) {
        $mensagem = 'Informe um código de tutor válido maior que zero.';
    } else {
        $mensagem = $inserir->cadastrarAnimal($conexao, $nome, $especie, $raca, $idade, $codigoTutor);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/estilo1.css">
    <title>Cadastro Animal</title>
</head>
<body id="animal" class="container py-4 bg-white text-dark">
    <?php // include('../COMPONENTES/cabecalho.php'); ?>
    <div id="cabecalho">
    <h1>Cadastro Animal</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" href="telaAnimal.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarAnimal.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link" href="atualizarAnimal.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirAnimal.php">Excluir</a></li>
    </ul>
    </div>

    <form method="POST">
        <label for="nome" class="form-label text-dark">Nome do Pet:</label><br>
        <input type="text" id="nome" name="nome" class="form-control" maxlength="150" required/><br><br>

        <label for="especie" class="form-label text-dark">Especie:</label><br>
        <input type="text" id="especie" name="especie" class="form-control" maxlength="50" required/><br><br>

        <label for="raca" class="form-label text-dark">Raça:</label><br>
        <input type="text" id="raca" name="raca" class="form-control" maxlength="50" required/><br><br>

        <label for="idade" class="form-label text-dark">Idade:</label><br>
        <input type="number" id="idade" name="idade" class="form-control" min="0" required/><br><br>

        <label for="codigoTutor" class="form-label text-dark">Código do Tutor:</label><br>
        <input type="number" id="codigoTutor" name="codigoTutor" class="form-control" min="1" required/><br><br>

        <button type="submit" class="btn btn-warning">Cadastrar</button>
    </form>

    <div>
        <?php echo $mensagem; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

</body>
</html>