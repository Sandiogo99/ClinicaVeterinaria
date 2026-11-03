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
                
                $sql  = "Insert into veterinario(codigo, nome, especialidade, 
                salario, endereco, telefone) values('','$nome','$especialidade',
                '$salario','$endereco','$telefone')";//Preparando o comando
                
                $result = mysqli_query($conn,$sql);//Executar o comando no bd
                //Verifico se executou ou não

                if($result){
                    return "<br><br>Inserido com sucesso!";
                }
                return "<br><br>Não inserido!";

            }
            catch(Exception $erro)
            {
                return "<br><br>Impossível cadastrar cliente <br><br> $erro";
            }
             
        }//fim do método cadastrar
            public function cadastrarTutor(Conexao $conexao, string $nome, string $cpf, string $telefone, string $email, string $endereco){
             try{
            $conn = $conexao->conectar();
            $sql = "Insert into tutor(codigo, nome, cpf, telefone, email, endereco) values('','$nome','$cpf','$telefone','$email','$endereco')";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "<br><br>Tutor inserido com sucesso!";
            }
            return "<br><br>Não inserido!";
        }catch(\Exception $erro){
            return "<br><br>Impossível cadastrar tutor <br><br>".$erro->getMessage();
        }
    }

    public function cadastrarAnimal(Conexao $conexao, string $nome, string $especie, string $raca, int $idade, int $codigoTutor){
        try{
            $conn = $conexao->conectar();
            $sql = "Insert into animal(codigo, nome, especie, raca, idade, codigoTutor) values('','$nome','$especie','$raca','$idade','$codigoTutor')";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "<br><br>Animal inserido com sucesso!";
            }
            return "<br><br>Não inserido!";
        }catch(\Exception $erro){
            return "<br><br>Impossível cadastrar animal <br><br>".$erro->getMessage();
        }//fim do método cadastrar
    }
    }//fim da classe