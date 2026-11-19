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
    $camposPermitidos = ['nome', 'cpf', 'telefone', 'email', 'endereco'];

    if ($codigo === false || $codigo < 1 || !in_array($campo, $camposPermitidos, true) || $novoDado === '') {
        $resultado = 'Informe um código, campo e novo dado válidos.';
    } elseif ($campo === 'cpf' && strlen(preg_replace('/\D/', '', $novoDado)) !== 11) {
        $resultado = 'Informe um CPF válido com 11 dígitos.';
    } elseif ($campo === 'email' && !filter_var($novoDado, FILTER_VALIDATE_EMAIL)) {
        $resultado = 'Informe um endereço de e-mail válido.';
    } else {
        if ($campo === 'cpf') {
            $novoDado = preg_replace('/\D/', '', $novoDado);
        }
        $resultado = $atualizar->atualizarTutor($conexao, $codigo, $campo, $novoDado);
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
    <title>Atualizar Tutor</title>
</head>
<body id="tutor" class="container py-4 bg-white text-dark">
    
    <?php // include('../COMPONENTES/cabecalho.php'); ?>

    <h1>Atualizar Tutor</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link" href="telaTutor.php">Cadastrar</a></li>
        <li class="nav-item"><a class="nav-link" href="consultarTutor.php">Consultar</a></li>
        <li class="nav-item"><a class="nav-link active" href="atualizarTutor.php">Atualizar</a></li>
        <li class="nav-item"><a class="nav-link" href="excluirTutor.php">Excluir</a></li>
    </ul>

    <form method="POST">
        <label for="codigo" class="form-label text-white">Código:</label><br>
        <input type="number" id="codigo" name="codigo" class="form-control" min="1" required/><br><br>

        <label for="campo" class="form-label text-white">Escolha o campo que deseja atualizar</label><br>
        <select name="campo" id="campo" class="form-control" required>
            <option value="nome">Nome</option>
            <option value="cpf">CPF</option>
            <option value="telefone">Telefone</option>
            <option value="email">Email</option>
            <option value="endereco">Endereço</option>
        </select><br><br>

        <label for="novoDado" class="form-label text-white">Informe o novo dado:</label><br>
        <input type="text" name="novoDado" id="novoDado" class="form-control" required/><br><br>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>

    <div class="mt-3">
        <?php echo $resultado; ?>
    </div>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>