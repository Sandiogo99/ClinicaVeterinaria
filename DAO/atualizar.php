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
                $conn   = $conexao->conectar();//Abrir a conexão com o BD
                $sql    = "update veterinario set $campo = '$novoDado' where codigo = '$codigo'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    return "<br><br>Dado Atualizado com sucesso!";
                } 
                return "<br><br>Dado não atualizado!";
            }catch(Exception $erro){
                return "<br><br>Algo deu errado<br><br>".$erro->getMessage();
            }
        }  function atualizarTutor(Conexao $conexao, int $codigo, string $campo, string $novoDado){
        try{
            $conn = $conexao->conectar();
            $sql = "update tutor set $campo = '$novoDado' where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "<br><br>Dado do Tutor atualizado!";
            }
            return "<br><br>Dado não atualizado!";
        }catch(\Exception $erro){
            return "<br><br>Algo deu errado<br><br>".$erro->getMessage();
        }
    }

    function atualizarAnimal(Conexao $conexao, int $codigo, string $campo, string $novoDado){
        try{
            $conn = $conexao->conectar();
            $sql = "update animal set $campo = '$novoDado' where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "<br><br>Dado do Animal atualizado!";
            }
            return "<br><br>Dado não atualizado!";
        }catch(\Exception $erro){
            return "<br><br>Algo deu errado<br><br>".$erro->getMessage();
        } //fim do método
    }//fim da classe
    }