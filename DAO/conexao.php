<?php
namespace ClinicaVeterinaria\projeto\DAO;

class Conexao
{
    public function conectar(): \mysqli
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $conn = new \mysqli('localhost', 'root', '', 'clinicaVeterinaria');
            $conn->set_charset('utf8mb4');

            return $conn;
        } catch (\mysqli_sql_exception $erro) {
            throw new \RuntimeException(
                'Não foi possível conectar ao banco de dados. Verifique se o MySQL está ativo e as credenciais estão corretas.',
                0,
                $erro
            );
        }
    }
}
