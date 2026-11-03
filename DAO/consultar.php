<?php
     namespace ClinicaVeterinaria\projeto\DAO;
     use ClinicaVeterinaria\projeto\DAO\Conexao;

     class Consultar{
        function consultarVeterinario(Conexao $conexao, int $codigo){
            try
            {
                $conn = $conexao->conectar();
                $sql  = "select * from veterinario where codigo = '$codigo'";
                $result = mysqli_query($conn, $sql);
                //Buscar os dados no banco
                while($dados = mysqli_fetch_Array($result)){
                    if($dados['codigo'] == $codigo){
                        return '<br>Código: '.$dados['codigo'].
                               '<br>Nome: '.$dados['nome'].
                               '<br>Especialidade: '.$dados['especialidade'].
                               '<br>Telefone: '.$dados['telefone'].
                               '<br>Endereço: '.$dados['endereco'].
                               '<br>Salário: '.$dados['salario'];
                    }//fim do if
                }return "Não encontrado!";//fim do while
            }
            catch(Exception $erro)
            {
                return "<br><br>Algo deu errado! <br><br>".$erro->getmessage();
            }
            function consultarTutor(Conexao $conexao, int $codigo){
        try{
            $conn = $conexao->conectar();
            $sql = "select * from tutor where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);
            while($dados = mysqli_fetch_array($result)){
                if($dados['codigo'] == $codigo){
                    return '<br>Código: '.$dados['codigo'].
                           '<br>Nome: '.$dados['nome'].
                           '<br>CPF: '.$dados['cpf'].
                           '<br>Telefone: '.$dados['telefone'].
                           '<br>Email: '.$dados['email'].
                           '<br>Endereço: '.$dados['endereco'];
                }
            }
            return "Tutor não encontrado!";
        }catch(\Exception $erro){
            return "<br><br>Algo deu errado! <br><br>".$erro->getMessage();
        }
    }

    function consultarAnimal(Conexao $conexao, int $codigo){
        try{
            $conn = $conexao->conectar();
            $sql = "select * from animal where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);
            while($dados = mysqli_fetch_array($result)){
                if($dados['codigo'] == $codigo){
                    return '<br>Código: '.$dados['codigo'].
                           '<br>Nome: '.$dados['nome'].
                           '<br>Espécie: '.$dados['especie'].
                           '<br>Raça: '.$dados['raca'].
                           '<br>Idade: '.$dados['idade'].
                           '<br>Código Tutor: '.$dados['codigoTutor'];
                }
            }
            return "Animal não encontrado!";
        }catch(\Exception $erro){
            return "<br><br>Algo deu errado! <br><br>".$erro->getMessage();
        }
        }//fim do consultarVeterinario
     }//fim do consultar
     }
     
