<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->bold("=== Teste de Cores ===")->eof()->eof();

// Cores básicas
$terminal->text("Cores básicas:")->eof();
$terminal->black("■ Preto")->eof();
$terminal->red("■ Vermelho")->eof();
$terminal->green("■ Verde")->eof();
$terminal->yellow("■ Amarelo")->eof();
$terminal->blue("■ Azul")->eof();
$terminal->magenta("■ Magenta")->eof();
$terminal->cyan("■ Ciano")->eof();
$terminal->white("■ Branco")->eof();
$terminal->eof();

// Cores brilhantes
$terminal->text("Cores brilhantes:")->eof();
$terminal->brightBlack("■ Preto Brilhante (Cinza)")->eof();
$terminal->brightRed("■ Vermelho Brilhante")->eof();
$terminal->brightGreen("■ Verde Brilhante")->eof();
$terminal->brightYellow("■ Amarelo Brilhante")->eof();
$terminal->brightBlue("■ Azul Brilhante")->eof();
$terminal->brightMagenta("■ Magenta Brilhante")->eof();
$terminal->brightCyan("■ Ciano Brilhante")->eof();
$terminal->brightWhite("■ Branco Brilhante")->eof();
$terminal->eof();

// Cores de fundo
$terminal->text("Cores de fundo:")->eof();
$terminal->bgRed("  Fundo Vermelho  ")->eof();
$terminal->bgGreen("  Fundo Verde  ")->eof();
$terminal->bgYellow("  Fundo Amarelo  ")->eof();
$terminal->bgBlue("  Fundo Azul  ")->eof();
$terminal->bgMagenta("  Fundo Magenta  ")->eof();
$terminal->bgCyan("  Fundo Ciano  ")->eof();
$terminal->eof();

// RGB personalizado
$terminal->text("RGB personalizado:")->eof();
$terminal->rgb("■ RGB(255, 100, 50)", 255, 100, 50)->eof();
$terminal->rgb("■ RGB(100, 200, 255)", 100, 200, 255)->eof();
$terminal->bgRgb("  Fundo RGB(200, 100, 255)  ", 200, 100, 255)->eof();
$terminal->eof();
