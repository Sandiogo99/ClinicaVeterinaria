<?php
    namespace ClinicaVeterinaria\projeto\DAO;
    use ClinicaVeterinaria\projeto\DAO\Conexao;

    class Inserir{
        public function cadastrarVeterinario(Conexao $conexao,
                                             string $nome,
                                             string $telefone,
                                             string $endereco,
                                             float $salario,
                                             string $especialidade)
        {
            try
            {
                $conn = $conexao->conectar();//Abre a conexão com o banco

                $verificar = $conn->prepare(
                    'SELECT codigo FROM veterinario
                     WHERE nome = ? AND especialidade = ? AND telefone = ?
                     LIMIT 1'
                );
                $verificar->bind_param('sss', $nome, $especialidade, $telefone);
                $verificar->execute();
                $existente = $verificar->get_result()->fetch_assoc();
                $verificar->close();

                if ($existente) {
                    return 'Já existe um veterinário com esses dados.';
                }

                $sql = 'INSERT INTO veterinario
                        (nome, especialidade, salario, endereco, telefone)
                        VALUES (?, ?, ?, ?, ?)';
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssdss', $nome, $especialidade, $salario, $endereco, $telefone);

                if ($stmt->execute()) {
                    $stmt->close();
                    return '<br><br>Veterinário inserido com sucesso!';
                }

                $stmt->close();
                return '<br><br>Não inserido!';
            }
            catch(\mysqli_sql_exception $erro)
            {
                return '<br><br>Não foi possível cadastrar o veterinário.';
            }
             
        }//fim do método cadastrar
            public function cadastrarTutor(Conexao $conexao, string $nome, string $cpf, string $telefone, string $email, string $endereco){
             try{
            $conn = $conexao->conectar();
            $verificar = $conn->prepare('SELECT codigo FROM tutor WHERE cpf = ? LIMIT 1');
            $verificar->bind_param('s', $cpf);
            $verificar->execute();
            $existente = $verificar->get_result()->fetch_assoc();
            $verificar->close();

            if ($existente) {
                return 'Já existe um tutor cadastrado com este CPF.';
            }

            $sql = 'INSERT INTO tutor (nome, cpf, telefone, email, endereco)
                    VALUES (?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssss', $nome, $cpf, $telefone, $email, $endereco);
            if($stmt->execute()){
                $stmt->close();
                return "<br><br>Tutor inserido com sucesso!";
            }
            $stmt->close();
            return "<br><br>Não inserido!";
        }catch(\mysqli_sql_exception $erro){
            return "<br><br>Não foi possível cadastrar o tutor.";
        }
    }

    public function cadastrarAnimal(Conexao $conexao, string $nome, string $especie, string $raca, int $idade, int $codigoTutor){
        try{
            $conn = $conexao->conectar();
            if ($idade < 0) {
                return 'A idade não pode ser negativa.';
            }

            $verificarTutor = $conn->prepare('SELECT codigo FROM tutor WHERE codigo = ? LIMIT 1');
            $verificarTutor->bind_param('i', $codigoTutor);
            $verificarTutor->execute();
            $tutor = $verificarTutor->get_result()->fetch_assoc();
            $verificarTutor->close();

            if (!$tutor) {
                return 'O código do tutor informado não existe.';
            }

            $verificar = $conn->prepare(
                'SELECT codigo FROM animal
                 WHERE nome = ? AND especie = ? AND raca = ? AND codigoTutor = ?
                 LIMIT 1'
            );
            $verificar->bind_param('sssi', $nome, $especie, $raca, $codigoTutor);
            $verificar->execute();
            $existente = $verificar->get_result()->fetch_assoc();
            $verificar->close();

            if ($existente) {
                return 'Esse animal já está cadastrado para este tutor.';
            }

            $sql = 'INSERT INTO animal (nome, especie, raca, idade, codigoTutor)
                    VALUES (?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssii', $nome, $especie, $raca, $idade, $codigoTutor);
            if($stmt->execute()){
                $stmt->close();
                return "<br><br>Animal inserido com sucesso!";
            }
            $stmt->close();
            return "<br><br>Não inserido!";
        }catch(\mysqli_sql_exception $erro){
            return "<br><br>Não foi possível cadastrar o animal.";
        }//fim do método cadastrar
    }
    }//fim da classe