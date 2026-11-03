<?php
namespace ClinicaVeterinaria\projeto\PHP;

require_once('Veterinario.php');
require_once('Tutor.php');
require_once('Animal.php');

use ClinicaVeterinaria\projeto\PHP\Veterinario;
use ClinicaVeterinaria\projeto\PHP\Tutor;
use ClinicaVeterinaria\projeto\PHP\Animal;

// --- Teste da Classe Veterinario ---
// Ordem correta: codigo, nome, especialidade, salario, endereco, telefone
$allan = new Veterinario(1, "Allan", "Clínico Geral", 13000.00, "Rua B1", "11956562323");
$joao = new Veterinario(2, "João", "Oftalmo", 20000.00, "Rua Geri", "11111111");
$cleide = new Veterinario(3, "Cleide", "Cardiologista", 20000.00, "Rua Pedro Afonso", "11956565656");

echo "<h2>--- VETERINÁRIOS ---</h2>";
echo $allan->imprimir();
echo $joao->imprimir();
echo $cleide->imprimir();

// --- Teste da Classe Tutor ---
// Ordem: codigo, nome, cpf, telefone, email, endereco
$tutor1 = new Tutor(1, "Carlos Silva", "123.456.789-00", "11988887777", "carlos@gmail.com", "Av. Paulista, 1000");

echo "<h2>--- TUTORES ---</h2>";
echo $tutor1->imprimir();

// --- Teste da Classe Animal ---
// Ordem: codigo, nome, especie, raca, idade, codigoTutor
$animal1 = new Animal(1, "Rex", "Cão", "Pastor Alemão", 4, 1);

echo "<h2>--- ANIMAIS ---</h2>";
echo $animal1->imprimir();
?>