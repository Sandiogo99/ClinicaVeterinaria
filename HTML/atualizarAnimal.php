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
    $codigo = filter_var($_POST['codigo'], FILTER_VALIDATE_INT);
    $campo = $_POST['campo'] ?? '';
    $novoDado = trim($_POST['novoDado'] ?? '');
    $camposPermitidos = ['nome', 'especie', 'raca', 'idade', 'codigoTutor'];

    if ($codigo === false || $codigo < 1 || !in_array($campo, $camposPermitidos, true) || $novoDado === '') {
        $resultado = 'Informe um código, campo e novo dado válidos.';
    } elseif (in_array($campo, ['idade', 'codigoTutor'], true)) {
        $valor = filter_var($novoDado, FILTER_VALIDATE_INT);
        $limite = $campo === 'idade' ? 0 : 1;
        if ($valor === false || $valor < $limite) {
            $resultado = $campo === 'idade'
                ? 'A idade deve ser um número inteiro maior ou igual a zero.'
                : 'Informe um código de tutor válido maior que zero.';
        } else {
            $resultado = $atualizar->atualizarAnimal($conexao, $codigo, $campo, (string)$valor);
        }
    } else {
        $resultado = $atualizar->atualizarAnimal($conexao, $codigo, $campo, $novoDado);
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
    <title>Atualizar Animal</title>
</head>
<body id="animal" class="container py-4 bg-white text-dark">
    <?php // include('../COMPONENTES/cabecalho.php'); ?>

    <h1>Atualizar Animal</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" href="telaAnimal.php">Cadastrar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="consultarAnimal.php">Consultar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="atualizarAnimal.php">Atualizar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="excluirAnimal.php">Excluir</a>
        </li>
    </ul>

    <form method="POST">
        <label for="codigo" class="form-label text-dark">Código:</label><br>
        <input type="number" id="codigo" name="codigo" class="form-control" min="1" required/><br><br>

        <label for="campo" class="form-label text-dark">Escolha o campo que deseja atualizar</label><br>
        <select name="campo" id="campo" class="form-control" required>
            <option value="nome">Nome</option>
            <option value="especie">Espécie</option>
            <option value="raca">Raça</option>
            <option value="idade">Idade</option>
            <option value="codigoTutor">Código Tutor</option>
        </select><br><br>

        <label for="novoDado" class="form-label text-dark">Informe o novo dado:</label><br>
        <input type="text" name="novoDado" id="novoDado" class="form-control"/><br><br>

        <button type="submit" class="btn btn-warning">Atualizar</button>
    </form>

    <div class="mt-3">
        <?php echo $resultado; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>