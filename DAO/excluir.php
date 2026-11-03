<?php
    namespace ClinicaVeterinaria\projeto\DAO;
    use ClinicaVeterinaria\projeto\DAO\Conexao;

    Class Excluir{
        function ExcluirVeterinario(Conexao $conexao, int $codigo){
            try{
                $conn   = $conexao->conectar();
                $sql    = "delete from veterinario where codigo = '$codigo'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    return "<br><br>Excluído com sucesso!";
                } 
                return "<br><br>Não Excluído!";
            }catch(Exception $erro){
                return "Algo deu errado! <br><br> $erro";
            }
        } 
        function excluirTutor(Conexao $conexao, int $codigo){
        try{
            $conn = $conexao->conectar();
            $sql = "delete from tutor where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "<br><br>Tutor excluído com sucesso!";
            }
            return "<br><br>Não Excluído!";
        }catch(\Exception $erro){
            return "Algo deu errado! <br><br>".$erro->getMessage();
        }
        }

        function excluirAnimal(Conexao $conexao, int $codigo){
        try{
            $conn = $conexao->conectar();
            $sql = "delete from animal where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "<br><br>Animal excluído com sucesso!";
            }
            return "<br><br>Não Excluído!";
        }catch(\Exception $erro){
            return "Algo deu errado! <br><br>".$erro->getMessage();
        }//fim da function
    }//fim do excluir
    }