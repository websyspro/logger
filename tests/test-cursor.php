<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->clear();
$terminal->bold("=== Teste de Controle de Cursor ===")->eof()->eof();

// Posicionamento
$terminal->text("Teste de posicionamento...")->eof();
sleep(1);

$terminal->cursorPosition(5, 10);
$terminal->green("← Texto na linha 5, coluna 10");
sleep(1);

$terminal->cursorPosition(7, 20);
$terminal->blue("← Texto na linha 7, coluna 20");
sleep(1);

$terminal->cursorPosition(9, 1);
$terminal->eof();

// Movimento
$terminal->text("Teste de movimento do cursor...")->eof();
$terminal->text("Início")->eof();
sleep(1);

$terminal->cursorUp(1);
$terminal->cursorForward(10);
$terminal->yellow(" <- Movido para o lado");
sleep(1);

$terminal->cursorDown(2);
$terminal->cursorPosition(15, 1);

// Salvar e restaurar
$terminal->text("Salvando posição...")->eof();
$terminal->cursorSave();
$terminal->cursorPosition(17, 10);
$terminal->red("Posição temporária");
sleep(1);
$terminal->cursorRestore();
$terminal->green("Posição restaurada!")->eof();

$terminal->cursorPosition(20, 1);
$terminal->eof();
