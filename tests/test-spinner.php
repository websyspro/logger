<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->clear();
$terminal->bold("=== Teste de Spinners ===")->eof()->eof();

// Spinner clássico
$terminal->text("Spinner clássico: | / - \\")->eof();
for ($i = 0; $i < 20; $i++) {
    $terminal->spinner($i, "Carregando...");
    usleep(100000);
}
$terminal->clearLine()->green("✓ Concluído!")->eof()->eof();
sleep(1);

// Spinner de pontos
$terminal->text("Spinner de pontos Unicode")->eof();
for ($i = 0; $i < 30; $i++) {
    $terminal->spinnerDots($i, "Processando dados...");
    usleep(100000);
}
$terminal->clearLine()->green("✓ Concluído!")->eof()->eof();
sleep(1);

// Spinner de setas
$terminal->text("Spinner de setas circulares")->eof();
for ($i = 0; $i < 24; $i++) {
    $terminal->spinnerArrow($i, "Sincronizando...");
    usleep(100000);
}
$terminal->clearLine()->green("✓ Concluído!")->eof()->eof();

// Ocultar e mostrar cursor
$terminal->text("Spinner sem cursor visível")->eof();
$terminal->cursorHide();
for ($i = 0; $i < 20; $i++) {
    $terminal->spinnerDots($i, "Aguarde...");
    usleep(100000);
}
$terminal->cursorShow();
$terminal->clearLine()->green("✓ Finalizado!")->eof()->eof();
