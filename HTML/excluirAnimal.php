<?php
namespace ClinicaVeterinaria\projeto\HTML;
require_once('../DAO/Conexao.php');
require_once('../DAO/Excluir.php');

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Excluir;

$conexao = new Conexao();
$excluir = new Excluir();
$resultado = "";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])){
    $codigo = (int)$_POST['codigo'];
    $resultado = $excluir->excluirAnimal($conexao, $codigo);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Excluir Animal</title>
</head>
<body class="container py-4 bg-white text-dark">
    <?php // include('../COMPONENTES/cabecalho.php'); ?>

    <h1>Excluir Animal</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link" href="telaAnimal.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarAnimal.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link" href="atualizarAnimal.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link active" href="excluirAnimal.php">Excluir</a></li>
    </ul>

    <form method="POST">
        <label>Código:</label><br>
        <input type="number" id="codigo" name="codigo"/><br><br>

        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>

    <div class="mt-3">
        <?php echo $resultado; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>