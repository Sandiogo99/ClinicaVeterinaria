<?php
namespace ClinicaVeterinaria\projeto\PHP;

class Tutor{
    private int $codigo;
    private string $nome;
    private string $cpf;
    private string $telefone;
    private string $email;
    private string $endereco;

    public function __construct(int $codigo, string $nome, string $cpf, string $telefone, string $email, string $endereco){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->endereco = $endereco;
    }

    public function __get(string $dados):mixed{
        return $this->$dados;
    }

    public function __set(string $variavel, string $novoDado):void{
        $this->$variavel = $novoDado;
    }

    public function imprimir():string{
        return "<br>Código: ".$this->codigo.
               "<br>Nome: ".$this->nome.
               "<br>CPF: ".$this->cpf.
               "<br>Telefone: ".$this->telefone.
               "<br>Email: ".$this->email.
               "<br>Endereço: ".$this->endereco."<br><br>";
    }
}
?><?php
namespace ClinicaVeterinaria\projeto\PHP;

class Tutor{
    private int $codigo;
    private string $nome;
    private string $cpf;
    private string $telefone;
    private string $email;
    private string $endereco;

    public function __construct(int $codigo, string $nome, string $cpf, string $telefone, string $email, string $endereco){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->endereco = $endereco;
    }

    public function __get(string $dados):mixed{
        return $this->$dados;
    }

    public function __set(string $variavel, string $novoDado):void{
        $this->$variavel = $novoDado;
    }

    public function imprimir():string{
        return "<br>Código: ".$this->codigo.
               "<br>Nome: ".$this->nome.
               "<br>CPF: ".$this->cpf.
               "<br>Telefone: ".$this->telefone.
               "<br>Email: ".$this->email.
               "<br>Endereço: ".$this->endereco."<br><br>";
    }
}
?>