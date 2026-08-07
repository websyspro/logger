# Testes da Classe Terminal

Este diretório contém testes práticos para demonstrar todas as funcionalidades da classe `Terminal`.

## Arquivos de Teste

### `test-colors.php`
Demonstra todas as cores disponíveis:
- Cores básicas (preto, vermelho, verde, amarelo, azul, magenta, ciano, branco)
- Cores brilhantes
- Cores de fundo
- Cores RGB personalizadas

**Como executar:**
```bash
php tests/test-colors.php
```

### `test-formatting.php`
Demonstra formatações de texto:
- Negrito
- Esmaecido (dim)
- Itálico
- Sublinhado
- Piscante
- Cores invertidas
- Tachado
- Combinações de formatações

**Como executar:**
```bash
php tests/test-formatting.php
```

### `test-cursor.php`
Demonstra controle de cursor:
- Posicionamento absoluto
- Movimento relativo (cima, baixo, esquerda, direita)
- Salvar e restaurar posição
- Ocultar e mostrar cursor

**Como executar:**
```bash
php tests/test-cursor.php
```

### `test-spinner.php`
Demonstra spinners animados:
- Spinner clássico: `| / - \`
- Spinner de pontos Unicode
- Spinner de setas circulares
- Spinner com cursor oculto

**Como executar:**
```bash
php tests/test-spinner.php
```

### `test-progress.php`
Demonstra barras de progresso:
- Barra de progresso simples
- Barra de progresso detalhada
- Barra customizada
- Simulação de múltiplas tarefas

**Como executar:**
```bash
php tests/test-progress.php
```

### `test-input.php`
Demonstra métodos de entrada interativa:
- Input simples de texto
- Confirmação Sim/Não
- Menu de escolha
- Formulário completo
- Entrada de senha (oculta em Linux/Mac)
- Loop interativo com validação

**Como executar:**
```bash
php tests/test-input.php
```

### `test-all.php`
Menu interativo para executar todos os testes:
- Opção de escolher teste individual
- Opção de executar todos os testes em sequência

**Como executar:**
```bash
php tests/test-all.php
```

## Requisitos

- PHP 7.4 ou superior
- Composer (para autoload)
- Terminal com suporte a códigos ANSI

## Instalação

Certifique-se de que o Composer está instalado e execute:

```bash
cd logger
composer install
```

## Exemplos de Uso

```php
use Websyspro\Logger\Terminal;

// Criar instância
$terminal = Terminal::init();

// Texto colorido
$terminal->green("Sucesso!")->eof();
$terminal->red("Erro!")->eof();

// Formatação
$terminal->bold("Importante")->eof();
$terminal->underline("Sublinhado")->eof();

// Input interativo
$name = $terminal->input("Qual seu nome? ");
$terminal->green("Olá, {$name}!")->eof();

// Confirmação
if ($terminal->confirm("Continuar?")) {
    $terminal->green("Continuando...")->eof();
}

// Menu de escolha
$option = $terminal->choice("Escolha:", [
    "1" => "Opção A",
    "2" => "Opção B",
    "3" => "Opção C"
]);

// Spinner
for ($i = 0; $i < 20; $i++) {
    $terminal->spinner($i, "Carregando...");
    usleep(100000);
}

// Barra de progresso
for ($i = 0; $i <= 100; $i++) {
    $terminal->progressBar($i, 100);
    usleep(50000);
}
```

## Notas

- Nem todos os terminais suportam todos os códigos ANSI
- O efeito `blink()` pode não funcionar em terminais modernos
- RGB requer terminal com suporte a 256 cores ou true color
