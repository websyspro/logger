<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Websyspro\Logger\Terminal;

$terminal = Terminal::init();

$terminal->bold("=== Teste de Formatação ===")->eof()->eof();

// Formatações de texto
$terminal->text("Formatações de texto:")->eof();
$terminal->bold("Texto em negrito")->eof();
$terminal->dim("Texto esmaecido (dim)")->eof();
$terminal->italic("Texto em itálico")->eof();
$terminal->underline("Texto sublinhado")->eof();
$terminal->blink("Texto piscante (pode não funcionar)")->eof();
$terminal->reverse("Texto com cores invertidas")->eof();
$terminal->strikethrough("Texto tachado")->eof();
$terminal->eof();

// Combinações
$terminal->text("Combinações:")->eof();
$terminal->bold("Negrito + ")->green("Verde")->eof();
$terminal->underline("Sublinhado + ")->red("Vermelho")->eof();
$terminal->bgYellow("Fundo Amarelo + ")->black("Texto Preto")->eof();
$terminal->eof();
