<?php
namespace ClinicaVeterinaria\projeto\HTML;

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Inserir;

require_once __DIR__ . '/../DAO/conexao.php';
require_once __DIR__ . '/../DAO/inserir.php';

$conexao = new Conexao();
$inserir = new Inserir();
$mensagem = null;
$campos = ['nome', 'especialidade', 'salario', 'telefone', 'endereco'];
$dadosFormulario = [];

foreach ($campos as $campo) {
    $valor = $_POST[$campo] ?? '';
    $dadosFormulario[$campo] = is_string($valor) ? trim($valor) : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $salario = filter_var($dadosFormulario['salario'], FILTER_VALIDATE_FLOAT);

    if (
        in_array('', $dadosFormulario, true)
        || $salario === false
        || $salario < 0
    ) {
        $mensagem = 'Preencha todos os campos com valores válidos.';
    } else {
        $mensagem = $inserir->cadastrarVeterinario(
            $conexao,
            $dadosFormulario['nome'],
            $dadosFormulario['telefone'],
            $dadosFormulario['endereco'],
            (float) $salario,
            $dadosFormulario['especialidade']
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
    <title>Cadastro de Veterinário</title>
</head>
<body id="veterinario" class="container py-4 bg-white text-dark">
    <?php // include __DIR__ . '/../COMPONENTES/cabecalho.php'; ?>
    <h1>Cadastro de Veterinário</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" href="telaVeterinario.php" aria-current="page">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarVeterinario.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link" href="atualizarVeterinario.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirVeterinario.php">Excluir</a></li>
    </ul>

    <form method="POST" action="telaVeterinario.php">
        <div class="mb-3">
            <label for="nome" class="form-label text-white">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" maxlength="250" required
                   value="<?= htmlspecialchars($dadosFormulario['nome'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="especialidade" class="form-label text-white">Especialidade:</label>
            <input type="text" class="form-control" id="especialidade" name="especialidade" maxlength="100" required
                   value="<?= htmlspecialchars($dadosFormulario['especialidade'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label text-white">Salário:</label>
            <input type="number" class="form-control" id="salario" name="salario" min="0" step="0.01" required
                   value="<?= htmlspecialchars($dadosFormulario['salario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label text-white">Telefone:</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" maxlength="20" required
                   value="<?= htmlspecialchars($dadosFormulario['telefone'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label text-white">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" maxlength="300" required
                   value="<?= htmlspecialchars($dadosFormulario['endereco'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        </div>
        <button type="submit" class="btn btn-primary text-white">Cadastrar</button>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </form>

    <?php if ($mensagem !== null): ?>
        <div class="mt-3" role="status">
            <?= nl2br(htmlspecialchars(str_replace('<br>', "\n", $mensagem), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
