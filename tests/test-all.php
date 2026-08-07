<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->clear();
$terminal->bold("╔════════════════════════════════════════╗")->eof();
$terminal->bold("║   TERMINAL CLASS - SUITE DE TESTES    ║")->eof();
$terminal->bold("╚════════════════════════════════════════╝")->eof();
$terminal->eof();

// Menu usando o método choice
$tests = [
    "1" => "Cores",
    "2" => "Formatação",
    "3" => "Controle de Cursor",
    "4" => "Spinners",
    "5" => "Barras de Progresso",
    "6" => "Métodos de Input",
    "7" => "Executar Todos",
    "0" => "Sair"
];

$choice = $terminal->choice("Escolha um teste:", $tests);

$terminal->eof();

switch ($choice) {
    case "1":
        require __DIR__ . '/test-colors.php';
        break;
    case "2":
        require __DIR__ . '/test-formatting.php';
        break;
    case "3":
        require __DIR__ . '/test-cursor.php';
        break;
    case "4":
        require __DIR__ . '/test-spinner.php';
        break;
    case "5":
        require __DIR__ . '/test-progress.php';
        break;
    case "6":
        require __DIR__ . '/test-input.php';
        break;
    case "7":
        $terminal->bold("Executando todos os testes...")->eof()->eof();
        sleep(1);
        
        $terminal->cyan("→ Teste de Cores")->eof();
        require __DIR__ . '/test-colors.php';
        sleep(2);
        
        $terminal->clear();
        $terminal->cyan("→ Teste de Formatação")->eof();
        require __DIR__ . '/test-formatting.php';
        sleep(2);
        
        $terminal->clear();
        $terminal->cyan("→ Teste de Cursor")->eof();
        require __DIR__ . '/test-cursor.php';
        sleep(2);
        
        $terminal->clear();
        $terminal->cyan("→ Teste de Spinners")->eof();
        require __DIR__ . '/test-spinner.php';
        sleep(2);
        
        $terminal->clear();
        $terminal->cyan("→ Teste de Barras de Progresso")->eof();
        require __DIR__ . '/test-progress.php';
        
        $terminal->clear();
        $terminal->cyan("→ Teste de Métodos de Input")->eof();
        require __DIR__ . '/test-input.php';
        
        $terminal->eof()->eof();
        $terminal->bold("╔════════════════════════════════════════╗")->eof();
        $terminal->bold("║     TODOS OS TESTES CONCLUÍDOS!        ║")->eof();
        $terminal->bold("╚════════════════════════════════════════╝")->eof();
        break;
    case "0":
        $terminal->yellow("Saindo...")->eof();
        exit(0);
    default:
        $terminal->red("✗ Opção inválida!")->eof();
}

$terminal->eof();

// Pergunta se quer executar novamente
if ($terminal->confirm("Deseja executar outro teste?")) {
    // Reexecuta o script
    $terminal->clear();
    require __FILE__;
} else {
    $terminal->green("Até logo!")->eof();
}
