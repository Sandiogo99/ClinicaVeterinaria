<?php
namespace ClinicaVeterinaria\projeto\PHP;

class Animal{
    private int $codigo;
    private string $nome;
    private string $especie;
    private string $raca;
    private int $idade;
    private int $codigoTutor;

    public function __construct(int $codigo, string $nome, string $especie, string $raca, int $idade, int $codigoTutor){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->especie = $especie;
        $this->raca = $raca;
        $this->idade = $idade;
        $this->codigoTutor = $codigoTutor;
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
               "<br>Espécie: ".$this->especie.
               "<br>Raça: ".$this->raca.
               "<br>Idade: ".$this->idade.
               "<br>Código do Tutor: ".$this->codigoTutor."<br><br>";
    }
}
?>