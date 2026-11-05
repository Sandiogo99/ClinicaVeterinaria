<?php
namespace ClinicaVeterinaria\projeto\DAO;

use ClinicaVeterinaria\projeto\DAO\Conexao;

class Consultar
{
    public function consultarVeterinario(Conexao $conexao, int $codigo): string
    {
        try {
            $conn = $conexao->conectar();
            $sql = 'SELECT * FROM veterinario WHERE codigo = ?';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $codigo);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $dados = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($dados === null) {
                return 'Não encontrado!';
            }

            return '<br>Código: ' . $dados['codigo'] .
                '<br>Nome: ' . $dados['nome'] .
                '<br>Especialidade: ' . $dados['especialidade'] .
                '<br>Telefone: ' . $dados['telefone'] .
                '<br>Endereço: ' . $dados['endereco'] .
                '<br>Salário: ' . $dados['salario'];
        } catch (\mysqli_sql_exception $erro) {
            return 'Algo deu errado ao consultar o veterinário.';
        }
    }

    public function consultarTutor(Conexao $conexao, int $codigo): string
    {
        try {
            $conn = $conexao->conectar();
            $sql = 'SELECT * FROM tutor WHERE codigo = ?';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $codigo);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $dados = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($dados === null) {
                return 'Tutor não encontrado!';
            }

            return '<br>Código: ' . $dados['codigo'] .
                '<br>Nome: ' . $dados['nome'] .
                '<br>CPF: ' . $dados['cpf'] .
                '<br>Telefone: ' . $dados['telefone'] .
                '<br>Email: ' . $dados['email'] .
                '<br>Endereço: ' . $dados['endereco'];
        } catch (\mysqli_sql_exception $erro) {
            return 'Algo deu errado ao consultar o tutor.';
        }
    }

    public function consultarAnimal(Conexao $conexao, int $codigo): string
    {
        try {
            $conn = $conexao->conectar();
            $sql = 'SELECT * FROM animal WHERE codigo = ?';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $codigo);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $dados = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($dados === null) {
                return 'Animal não encontrado!';
            }

            return '<br>Código: ' . $dados['codigo'] .
                '<br>Nome: ' . $dados['nome'] .
                '<br>Espécie: ' . $dados['especie'] .
                '<br>Raça: ' . $dados['raca'] .
                '<br>Idade: ' . $dados['idade'] .
                '<br>Código Tutor: ' . $dados['codigoTutor'];
        } catch (\mysqli_sql_exception $erro) {
            return 'Algo deu errado ao consultar o animal.';
        }
    }
}
