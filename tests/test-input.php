<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->clear();
$terminal->bold("=== Teste de Métodos de Input ===")->eof()->eof();

// Teste 1: Input simples
$terminal->cyan("1. Input Simples")->eof();
$name = $terminal->input("Digite seu nome: ");
$terminal->green("Olá, {$name}!")->eof()->eof();

// Teste 2: Confirmação
$terminal->cyan("2. Confirmação (Sim/Não)")->eof();
if ($terminal->confirm("Você gosta de programar?")) {
    $terminal->green("✓ Ótimo! Programar é incrível!")->eof();
} else {
    $terminal->yellow("⚠ Tudo bem, cada um com seu gosto!")->eof();
}
$terminal->eof();

// Teste 3: Confirmação com padrão "Não"
$terminal->cyan("3. Confirmação com padrão 'Não'")->eof();
if ($terminal->confirm("Deseja deletar todos os arquivos?", false)) {
    $terminal->red("✗ Arquivos deletados!")->eof();
} else {
    $terminal->green("✓ Operação cancelada. Arquivos seguros!")->eof();
}
$terminal->eof();

// Teste 4: Menu de escolha
$terminal->cyan("4. Menu de Escolha")->eof();
$languages = [
    "1" => "PHP",
    "2" => "JavaScript",
    "3" => "Python",
    "4" => "Ruby",
    "5" => "Go"
];

$choice = $terminal->choice("Qual sua linguagem favorita?", $languages);
if (isset($languages[$choice])) {
    $terminal->green("✓ Você escolheu: {$languages[$choice]}")->eof();
} else {
    $terminal->red("✗ Opção inválida!")->eof();
}
$terminal->eof();

// Teste 5: Múltiplos inputs
$terminal->cyan("5. Formulário Completo")->eof();
$terminal->bold("Cadastro de Usuário")->eof()->eof();

$userData = [];
$userData['nome'] = $terminal->input("Nome: ");
$userData['email'] = $terminal->input("E-mail: ");
$userData['idade'] = $terminal->input("Idade: ");

$terminal->eof();
$terminal->bold("Dados cadastrados:")->eof();
foreach ($userData as $campo => $valor) {
    $terminal->text("  ")->cyan(ucfirst($campo) . ":")->text(" {$valor}")->eof();
}
$terminal->eof();

// Teste 6: Password (funciona melhor em Linux/Mac)
$terminal->cyan("6. Entrada de Senha")->eof();
$terminal->yellow("Nota: Entrada oculta funciona apenas em Linux/Mac")->eof();
$password = $terminal->password("Digite uma senha: ");
$terminal->green("✓ Senha capturada com sucesso! (tamanho: " . strlen($password) . " caracteres)")->eof();
$terminal->eof();

// Teste 7: Loop interativo
$terminal->cyan("7. Loop Interativo")->eof();
$terminal->text("Digite números (digite 'sair' para parar):")->eof();
$sum = 0;
$count = 0;

while (true) {
    $input = $terminal->input("Número #{$count}: ");
    
    if (strtolower($input) === 'sair') {
        break;
    }
    
    if (is_numeric($input)) {
        $sum += floatval($input);
        $count++;
        $terminal->dim("  → Soma atual: {$sum}")->eof();
    } else {
        $terminal->red("  ✗ Digite um número válido!")->eof();
    }
}

if ($count > 0) {
    $average = $sum / $count;
    $terminal->eof();
    $terminal->green("✓ Você digitou {$count} números")->eof();
    $terminal->green("✓ Soma total: {$sum}")->eof();
    $terminal->green("✓ Média: " . number_format($average, 2))->eof();
}

$terminal->eof();
$terminal->bold("Teste de Input concluído!")->eof();
