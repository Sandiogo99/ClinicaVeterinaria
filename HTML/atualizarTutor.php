<?php
namespace ClinicaVeterinaria\projeto\HTML;
require_once('../DAO/Conexao.php');
require_once('../DAO/Atualizar.php');

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Atualizar;

$conexao = new Conexao();
$atualizar = new Atualizar();
$resultado = "";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])){
    $codigo = (int)$_POST['codigo'];
    $campo = $_POST['campo'];
    $novoDado = $_POST['novoDado'];
    $resultado = $atualizar->atualizarTutor($conexao, $codigo, $campo, $novoDado);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Atualizar Tutor</title>
</head>
<body class="container py-4 bg-white text-dark">
    
    <?php // include('../COMPONENTES/cabecalho.php'); ?>

    <h1>Atualizar Tutor</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link" href="telaTutor.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarTutor.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link active" href="atualizarTutor.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirTutor.php">Excluir</a></li>
    </ul>

    <form method="POST">
        <label>Código:</label><br>
        <input type="number" id="codigo" name="codigo"/><br><br>

        <label>Escolha o campo que deseja atualizar</label><br>
        <select name="campo" id="campo">
            <option value="nome">Nome</option>
            <option value="cpf">CPF</option>
            <option value="telefone">Telefone</option>
            <option value="email">Email</option>
            <option value="endereco">Endereço</option>
        </select><br><br>

        <label>Informe o novo dado:</label><br>
        <input type="text" name="novoDado" id="novoDado"/><br><br>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>

    <div class="mt-3">
        <?php echo $resultado; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>