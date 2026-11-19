<?php
    namespace ClinicaVeterinaria\projeto\DAO;
    use ClinicaVeterinaria\projeto\DAO\Conexao;

    Class Excluir{
        function ExcluirVeterinario(Conexao $conexao, int $codigo){
            try{
                $conn   = $conexao->conectar();
                $stmt = $conn->prepare('DELETE FROM veterinario WHERE codigo = ?');
                $stmt->bind_param('i', $codigo);
                $stmt->execute();
                if($stmt->affected_rows > 0){
                    $stmt->close();
                    return "<br><br>Excluído com sucesso!";
                }
                $stmt->close();
                return "<br><br>Veterinário não encontrado!";
            }catch(\mysqli_sql_exception $erro){
                return "Não foi possível excluir o veterinário.";
            }
        } 
        function excluirTutor(Conexao $conexao, int $codigo){
        try{
            $conn = $conexao->conectar();
            $stmt = $conn->prepare('DELETE FROM tutor WHERE codigo = ?');
            $stmt->bind_param('i', $codigo);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $stmt->close();
                return "<br><br>Tutor excluído com sucesso!";
            }
            $stmt->close();
            return "<br><br>Tutor não encontrado!";
        }catch(\mysqli_sql_exception $erro){
            return "Não foi possível excluir o tutor. Verifique se ele possui animais vinculados.";
        }
        }

        function excluirAnimal(Conexao $conexao, int $codigo){
        try{
            $conn = $conexao->conectar();
            $stmt = $conn->prepare('DELETE FROM animal WHERE codigo = ?');
            $stmt->bind_param('i', $codigo);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $stmt->close();
                return "<br><br>Animal excluído com sucesso!";
            }
            $stmt->close();
            return "<br><br>Animal não encontrado!";
        }catch(\mysqli_sql_exception $erro){
            return "Não foi possível excluir o animal.";
        }//fim da function
    }//fim do excluir
    }