<?php
namespace ClinicaVeterinaria\projeto\HTML;

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Atualizar;

require_once __DIR__ . '/../DAO/conexao.php';
require_once __DIR__ . '/../DAO/atualizar.php';

$conexao = new Conexao();
$atualizar = new Atualizar();
$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
    $campo = $_POST['campo'] ?? '';
    $novoDado = $_POST['novoDado'] ?? '';
    $camposPermitidos = ['nome', 'telefone', 'especialidade', 'endereco', 'salario'];

    if (
        $codigo === false
        || $codigo === null
        || $codigo < 1
        || !is_string($campo)
        || !in_array($campo, $camposPermitidos, true)
        || !is_string($novoDado)
        || trim($novoDado) === ''
    ) {
        $resultado = 'Informe um código, campo e novo dado válidos.';
    } else {
        $resultado = $atualizar->atualizarVeterinario(
            $conexao,
            $codigo,
            $campo,
            trim($novoDado)
        );
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
    <title>Atualizar Veterinario</title>
</head>
<body id="veterinario" class="container py-4 bg-white text-dark">
    <?php // include __DIR__ . '/../COMPONENTES/cabecalho.php'; ?>
    <h1>Atualizar Veterinário</h1>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link" href="telaVeterinario.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarVeterinario.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link active" href="atualizarVeterinario.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirVeterinario.php">Excluir</a></li>
    </ul>

    <form method="POST" action="atualizarVeterinario.php">
        <label for="codigo">Código</label>
        <input type="number" id="codigo" name="codigo" min="1" required><br><br>

        <label for="campo">Escolha o campo que deseja atualizar</label>
        <select name="campo" id="campo" required>
            <option value="nome">Nome</option>
            <option value="telefone">Telefone</option>
            <option value="especialidade">Especialidade</option>
            <option value="endereco">Endereço</option>
            <option value="salario">Salário</option>
        </select><br><br>

        <label for="novoDado">Informe o novo dado:</label>
        <input type="text" name="novoDado" id="novoDado" required><br><br>

        <button type="submit">Atualizar</button>
    </form>
    <?php if ($resultado !== null): ?>
        <div class="mt-3" role="status">
            <?= htmlspecialchars(strip_tags(str_replace('<br>', "\n", $resultado)), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
        </div>
    <?php endif; ?>
    <a href="../index.php"><button>Voltar</button></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>