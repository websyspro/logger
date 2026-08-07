<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->clear();
$terminal->bold("=== Teste de Barras de Progresso ===")->eof()->eof();

// Barra simples
$terminal->text("Barra de progresso simples:")->eof();
for ($i = 0; $i <= 100; $i++) {
    $terminal->progressBar($i, 100);
    usleep(50000);
}
$terminal->eof()->green("✓ Concluído!")->eof()->eof();
sleep(1);

// Barra detalhada
$terminal->text("Barra de progresso detalhada:")->eof();
for ($i = 0; $i <= 50; $i++) {
    $terminal->progressBarDetailed($i, 50, 40, "Download");
    usleep(80000);
}
$terminal->eof()->green("✓ Download completo!")->eof()->eof();
sleep(1);

// Barra customizada
$terminal->text("Barra de progresso customizada:")->eof();
for ($i = 0; $i <= 80; $i++) {
    $terminal->progressBar($i, 80, 60, "█");
    usleep(40000);
}
$terminal->eof()->green("✓ Upload completo!")->eof()->eof();

// Múltiplas tarefas
$terminal->text("Simulando múltiplas tarefas:")->eof()->eof();
$terminal->cursorHide();

$tasks = [
    ["name" => "Compilando", "total" => 30],
    ["name" => "Testando", "total" => 20],
    ["name" => "Empacotando", "total" => 15]
];

foreach ($tasks as $task) {
    for ($i = 0; $i <= $task["total"]; $i++) {
        $terminal->progressBarDetailed($i, $task["total"], 40, $task["name"]);
        usleep(100000);
    }
    $terminal->eof()->green("✓ {$task['name']} concluído!")->eof();
}

$terminal->cursorShow();
$terminal->eof()->bold("Todas as tarefas finalizadas!")->eof();
