<?php
namespace ClinicaVeterinaria\projeto\HTML;

use ClinicaVeterinaria\projeto\DAO\Conexao;
use ClinicaVeterinaria\projeto\DAO\Consultar;

require_once __DIR__ . '/../DAO/conexao.php';
require_once __DIR__ . '/../DAO/consultar.php';

$conexao = new Conexao();
$consultar = new Consultar();
$resultado = null;
$codigoInformado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoInformado = $_POST['codigo'] ?? '';
    $codigo = is_string($codigoInformado)
    ? filter_var($codigoInformado, FILTER_VALIDATE_INT)
    : false;

    if ($codigo === false || $codigo < 1) {
    $resultado = 'Informe um código válido.';
    } else {
    $resultado = $consultar->consultarVeterinario($conexao, $codigo);
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
    <title>Consultar Veterinario</title>
</head>
<body id="veterinario" class="container py-4 bg-white text-dark">
    <?php // include __DIR__ . '/../COMPONENTES/cabecalho.php'; ?>
    <h1>Consultar Veterinário</h1>
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="telaVeterinario.php">Cadastrar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="consultarVeterinario.php">Consultar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="atualizarVeterinario.php">Atualizar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="excluirVeterinario.php">Excluir</a>
        </li>
    </ul>
    <form method="POST" action="consultarVeterinario.php">
        <label for="codigo" class="form-label text-white">Código:</label>
        <input type="number" id="codigo" name="codigo" min="1" required
               value="<?= htmlspecialchars(is_string($codigoInformado) ? $codigoInformado : '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        <br><br>
        <button type="submit" class="btn btn-primary">Consultar</button>
    </form> 
    <?php if ($resultado !== null): ?>
        <div class="mt-3" role="status">
            <?php
            $linhasResultado = preg_split('/<br\s*\/?>/i', $resultado);
            foreach ($linhasResultado as $indice => $linha):
                if ($indice > 0) {
                    echo '<br>';
                }
                echo htmlspecialchars($linha, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            endforeach;
            ?>
        </div>
    <?php endif; ?>
    <a href="../index.php"><button>Voltar</button></a>   
</body>
</html>