<?php
    namespace ClinicaVeterinaria\projeto\DAO;
    use ClinicaVeterinaria\projeto\DAO\Conexao;

    Class Atualizar{
        function atualizarVeterinario(Conexao $conexao,
                           int $codigo,
                           string $campo,
                           string $novoDado)
        {
            try{
                $conn = $conexao->conectar();
                $camposPermitidos = [
                    'nome' => 's',
                    'telefone' => 's',
                    'especialidade' => 's',
                    'endereco' => 's',
                    'salario' => 'd'
                ];
                if (!isset($camposPermitidos[$campo])) {
                    return 'Campo inválido.';
                }

                $verificar = $conn->prepare('SELECT codigo FROM veterinario WHERE codigo = ?');
                $verificar->bind_param('i', $codigo);
                $verificar->execute();
                $existente = $verificar->get_result()->fetch_assoc();
                $verificar->close();
                if (!$existente) {
                    return 'Veterinário não encontrado!';
                }

                $sql = "UPDATE veterinario SET `$campo` = ? WHERE codigo = ?";
                $stmt = $conn->prepare($sql);
                $tipo = $camposPermitidos[$campo];
                if ($tipo === 'd') {
                    $valor = (float)$novoDado;
                    $stmt->bind_param('di', $valor, $codigo);
                } else {
                    $stmt->bind_param('si', $novoDado, $codigo);
                }
                $result = $stmt->execute();
                $stmt->close();
                if($result){
                    return "<br><br>Dado Atualizado com sucesso!";
                } 
                return "<br><br>Dado não atualizado!";
            }catch(\mysqli_sql_exception $erro){
                return "<br><br>Não foi possível atualizar o veterinário.";
            }
        }  function atualizarTutor(Conexao $conexao, int $codigo, string $campo, string $novoDado){
        try{
            $conn = $conexao->conectar();
            $camposPermitidos = ['nome', 'cpf', 'telefone', 'email', 'endereco'];
            if (!in_array($campo, $camposPermitidos, true)) {
                return 'Campo inválido.';
            }
            $verificar = $conn->prepare('SELECT codigo FROM tutor WHERE codigo = ?');
            $verificar->bind_param('i', $codigo);
            $verificar->execute();
            $existente = $verificar->get_result()->fetch_assoc();
            $verificar->close();
            if (!$existente) {
                return 'Tutor não encontrado!';
            }
            if ($campo === 'cpf') {
                $verificarCpf = $conn->prepare('SELECT codigo FROM tutor WHERE cpf = ? AND codigo <> ? LIMIT 1');
                $verificarCpf->bind_param('si', $novoDado, $codigo);
                $verificarCpf->execute();
                $cpfExistente = $verificarCpf->get_result()->fetch_assoc();
                $verificarCpf->close();
                if ($cpfExistente) {
                    return 'Já existe outro tutor cadastrado com este CPF.';
                }
            }
            $sql = "UPDATE tutor SET `$campo` = ? WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $novoDado, $codigo);
            $result = $stmt->execute();
            $stmt->close();
            if($result){
                return "<br><br>Dado do Tutor atualizado!";
            }
            return "<br><br>Dado não atualizado!";
        }catch(\mysqli_sql_exception $erro){
            return "<br><br>Não foi possível atualizar o tutor.";
        }
    }

    function atualizarAnimal(Conexao $conexao, int $codigo, string $campo, string $novoDado){
        try{
            $conn = $conexao->conectar();
            $camposPermitidos = ['nome', 'especie', 'raca', 'idade', 'codigoTutor'];
            if (!in_array($campo, $camposPermitidos, true)) {
                return 'Campo inválido.';
            }
            $verificar = $conn->prepare('SELECT codigo FROM animal WHERE codigo = ?');
            $verificar->bind_param('i', $codigo);
            $verificar->execute();
            $existente = $verificar->get_result()->fetch_assoc();
            $verificar->close();
            if (!$existente) {
                return 'Animal não encontrado!';
            }
            $tipoNumerico = in_array($campo, ['idade', 'codigoTutor'], true);
            if ($tipoNumerico) {
                $valor = filter_var($novoDado, FILTER_VALIDATE_INT);
                if ($valor === false || $valor < ($campo === 'idade' ? 0 : 1)) {
                    return 'Informe um valor numérico válido.';
                }
                if ($campo === 'codigoTutor') {
                    $verificarTutor = $conn->prepare('SELECT codigo FROM tutor WHERE codigo = ?');
                    $verificarTutor->bind_param('i', $valor);
                    $verificarTutor->execute();
                    $tutor = $verificarTutor->get_result()->fetch_assoc();
                    $verificarTutor->close();
                    if (!$tutor) {
                        return 'O código do tutor informado não existe.';
                    }
                }
            }
            $sql = "UPDATE animal SET `$campo` = ? WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            if ($tipoNumerico) {
                $stmt->bind_param('ii', $valor, $codigo);
            } else {
                $stmt->bind_param('si', $novoDado, $codigo);
            }
            $result = $stmt->execute();
            $stmt->close();
            if($result){
                return "<br><br>Dado do Animal atualizado!";
            }
            return "<br><br>Dado não atualizado!";
        }catch(\mysqli_sql_exception $erro){
            return "<br><br>Não foi possível atualizar o animal.";
        } //fim do método
    }//fim da classe
    }