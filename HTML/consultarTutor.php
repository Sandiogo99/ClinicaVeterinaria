<?php
namespace ClinicaVeterinaria\projeto\HTML;
require_once('../DAO/Conexao.php');
require_once('../DAO/Consultar.php');

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Consultar;

$conexao = new Conexao();
$consultar = new Consultar();
$resultado = "";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])){
    $codigo = (int)$_POST['codigo'];
    $resultado = $consultar->consultarTutor($conexao, $codigo);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilo1.css">

    <title>Consultar Tutor</title>
</head>
<body id="tutor" class="container py-4 bg-white text-dark">
    <?php // include('../COMPONENTES/cabecalho.php'); ?>

    <h1>Consultar Tutor</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link" href="telaTutor.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link active" href="consultarTutor.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link" href="atualizarTutor.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirTutor.php">Excluir</a></li>
    </ul>

    <form method="POST">
        <label>Código:</label><br>
        <input type="number" id="codigo" name="codigo"/><br><br>
        <button type="submit" class="btn btn-success">Consultar</button>
    </form>

    <div class="mt-3">
        <?php echo $resultado; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>