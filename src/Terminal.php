<?php

namespace Websyspro\Logger;

use function sprintf;
use function in_array;

/**
 * Class Terminal
 * 
 * Classe para manipulação de saída e formatação no terminal usando códigos ANSI.
 * Fornece métodos para controle de cursor, cores, formatação de texto e mensagens semânticas.
 * 
 * @package Websyspro\Logger
 */
class Terminal
{
  /**
   * Escreve um valor no STDOUT (saída padrão)
   * 
   * @param string $value O valor a ser escrito
   * @param bool $flush Se true, força a saída imediata com fflush()
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  private function write(
    string $value,
    bool $flush = false
  ): static {
    fwrite(STDOUT, $value);

    if ($flush) {
      fflush(STDOUT);
    }

    return $this;
  }

  /**
   * Limpa completamente a tela do terminal e move o cursor para o início
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function clear(
  ): static {
    return $this->write(
      "\033[2J\033[H", true
    );
  }

  /**
   * Limpa apenas a linha atual do cursor
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function clearLine(
  ): static  {
    return $this->write(
      "\033[2K"
    );
  }

  // ========== Cursor Control ==========

  /**
   * Move o cursor para cima N linhas
   * 
   * @param int $lines Número de linhas para mover (padrão: 1)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorUp(
    int $lines = 1
  ): static {
    return $this->write(
      "\033[{$lines}A"
    );
  }

  /**
   * Move o cursor para baixo N linhas
   * 
   * @param int $lines Número de linhas para mover (padrão: 1)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorDown(
    int $lines = 1
  ): static {
    return $this->write(
      "\033[{$lines}B"
    );
  }

  /**
   * Move o cursor para frente N colunas
   * 
   * @param int $columns Número de colunas para mover (padrão: 1)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorForward(
    int $columns = 1
  ): static {
    return $this->write(
      "\033[{$columns}C"
    );
  }

  /**
   * Move o cursor para trás N colunas
   * 
   * @param int $columns Número de colunas para mover (padrão: 1)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorBack(
    int $columns = 1
  ): static {
    return $this->write(
      "\033[{$columns}D"
    );
  }

  /**
   * Posiciona o cursor em uma linha e coluna específicas
   * 
   * @param int $row Número da linha (começa em 1)
   * @param int $col Número da coluna (começa em 1)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorPosition(
    int $row = 1,
    int $col = 1
  ): static {
    return $this->write(
      "\033[{$row};{$col}H"
    );
  }

  /**
   * Salva a posição atual do cursor
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorSave(
  ): static {
    return $this->write(
      "\033[s"
    );
  }

  /**
   * Restaura a posição do cursor previamente salva
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorRestore(
  ): static {
    return $this->write(
      "\033[u"
    );
  }

  /**
   * Oculta o cursor do terminal
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorHide(
  ): static {
    return $this->write(
      "\033[?25l"
    );
  }

  /**
   * Torna o cursor visível novamente
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cursorShow(
  ): static {
    return $this->write(
      "\033[?25h"
    );
  }

  // ========== Text Formatting ==========

  /**
   * Aplica formatação em negrito ao texto
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bold(
    string $text
  ): static {
    return $this->write(
      "\033[1m{$text}\033[0m"
    );
  }

  /**
   * Aplica formatação esmaecida (dim) ao texto
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function dim(
    string $text
  ): static {
    return $this->write(
      "\033[2m{$text}\033[0m"
    );
  }

  /**
   * Aplica formatação em itálico ao texto
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function italic(
    string $text
  ): static {
    return $this->write(
      "\033[3m{$text}\033[0m"
    );
  }

  /**
   * Aplica sublinhado ao texto
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function underline(
    string $text
  ): static {
    return $this->write(
      "\033[4m{$text}\033[0m"
    );
  }

  /**
   * Faz o texto piscar (pode não funcionar em todos os terminais)
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function blink(
    string $text
  ): static {
    return $this->write(
      "\033[5m{$text}\033[0m"
    );
  }

  /**
   * Inverte as cores de texto e fundo
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function reverse(
    string $text
  ): static {
    return $this->write(
      "\033[7m{$text}\033[0m"
    );
  }

  /**
   * Aplica tachado (strikethrough) ao texto
   * 
   * @param string $text O texto a ser formatado
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function strikethrough(
    string $text
  ): static {
    return $this->write(
      "\033[9m{$text}\033[0m"
    );
  }

  // ========== Foreground Colors ==========

  /**
   * Aplica cor preta ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function black(
    string $text
  ): static {
    return $this->write(
      "\033[30m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor vermelha ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function red(
    string $text
  ): static {
    return $this->write(
      "\033[31m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor verde ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function green(
    string $text
  ): static {
    return $this->write(
      "\033[32m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor amarela ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function yellow(
    string $text
  ): static {
    return $this->write(
      "\033[33m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor azul ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function blue(
    string $text
  ): static {
    return $this->write(
      "\033[34m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor magenta ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function magenta(
    string $text
  ): static {
    return $this->write(
      "\033[35m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor ciano ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function cyan(
    string $text
  ): static {
    return $this->write(
      "\033[36m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor branca ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function white(
    string $text
  ): static {
    return $this->write(
      "\033[37m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor preta brilhante (cinza) ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightBlack(
    string $text
  ): static {
    return $this->write(
      "\033[90m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor vermelha brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightRed(
    string $text
  ): static {
    return $this->write(
      "\033[91m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor verde brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightGreen(
    string $text
  ): static {
    return $this->write(
      "\033[92m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor amarela brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightYellow(
    string $text
  ): static {
    return $this->write(
      "\033[93m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor azul brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightBlue(
    string $text
  ): static {
    return $this->write(
      "\033[94m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor magenta brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightMagenta(
    string $text
  ): static {
    return $this->write(
      "\033[95m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor ciano brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightCyan(
    string $text
  ): static {
    return $this->write(
      "\033[96m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor branca brilhante ao texto
   * 
   * @param string $text O texto a ser colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function brightWhite(
    string $text
  ): static {
    return $this->write(
      "\033[97m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo preta ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgBlack(
    string $text
  ): static {
    return $this->write(
      "\033[40m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo vermelha ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgRed(
    string $text
  ): static {
    return $this->write(
      "\033[41m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo verde ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgGreen(
    string $text
  ): static {
    return $this->write(
      "\033[42m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo amarela ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgYellow(
    string $text
  ): static {
    return $this->write(
      "\033[43m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo azul ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgBlue(
    string $text
  ): static {
    return $this->write(
      "\033[44m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo magenta ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgMagenta(
    string $text
  ): static {
    return $this->write(
      "\033[45m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo ciano ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgCyan(
    string $text
  ): static {
    return $this->write(
      "\033[46m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo branca ao texto
   * 
   * @param string $text O texto a ter o fundo colorido
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgWhite(
    string $text
  ): static {
    return $this->write(
      "\033[47m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor RGB personalizada ao texto (suporte a 256 cores)
   * 
   * @param string $text O texto a ser colorido
   * @param int $r Valor vermelho (0-255)
   * @param int $g Valor verde (0-255)
   * @param int $b Valor azul (0-255)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function rgb(
    string $text,
    int $r,
    int $g,
    int $b
  ): static {
    return $this->write(
      "\033[38;2;{$r};{$g};{$b}m{$text}\033[0m"
    );
  }

  /**
   * Aplica cor de fundo RGB personalizada ao texto (suporte a 256 cores)
   * 
   * @param string $text O texto a ter o fundo colorido
   * @param int $r Valor vermelho (0-255)
   * @param int $g Valor verde (0-255)
   * @param int $b Valor azul (0-255)
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function bgRgb(
    string $text,
    int $r,
    int $g,
    int $b
  ): static {
    return $this->write(
      "\033[48;2;{$r};{$g};{$b}m{$text}\033[0m"
    );
  }

  /**
   * Escreve texto simples sem formatação adicional
   * 
   * @param string $text O texto a ser escrito
   * @param bool $flush Se true, força a saída imediata
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function text(
    string $text,
    bool $flush = false
  ): static {
    return $this->write(
      $text, $flush
    );
  }

  /**
   * Escreve uma linha de texto com quebra de linha ao final
   * 
   * @param string $text O texto a ser escrito (padrão: string vazia)
   * @param bool $flush Se true, força a saída imediata
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function line(
    string $text = "",
    bool $flush = false
  ): static {
    return $this->write(
      "{$text}\n", $flush
    );
  }

  /**
   * Adiciona uma quebra de linha (end of line)
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function eof(
  ): static {
    return $this->write(
      "\n"
    );
  }

  /**
   * Reseta todas as formatações aplicadas ao texto
   * 
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function reset(
  ): static {
    return $this->write(
      "\033[0m"
    );
  }

  // ========== Input Methods ==========

  /**
   * Solicita uma entrada do usuário com um prompt opcional
   * 
   * @param string $prompt Texto a ser exibido antes da entrada (opcional)
   * @return string Texto digitado pelo usuário (sem quebra de linha)
   */
  public function input(
    string $prompt = ""
  ): string {
    if ($prompt) {
      $this->write($prompt);
    }
    
    return trim(fgets(STDIN));
  }

  /**
   * Solicita confirmação do usuário (Sim/Não)
   * 
   * @param string $question Pergunta a ser feita
   * @param bool $defaultYes Se true, padrão é Sim (padrão: true)
   * @return bool true se confirmado, false caso contrário
   */
  public function confirm(
    string $question,
    bool $defaultYes = true
  ): bool {
    $options = $defaultYes ? "[S/n]" : "[s/N]";
    $this->write("{$question} {$options}: ");
    
    $response = strtolower(trim(fgets(STDIN)));
    
    if ($response === "") {
      return $defaultYes;
    }
    
    return in_array($response, ["s", "sim", "y", "yes"]);
  }

  /**
   * Apresenta um menu de escolha para o usuário
   * 
   * @param string $question Pergunta/título do menu
   * @param array $options Array de opções (key => label)
   * @return string A chave da opção escolhida
   */
  public function choice(
    string $question,
    array $options
  ): string {
    $this->text($question)->eof();
    
    foreach ($options as $key => $label) {
      $this->cyan("  [{$key}]")->text(" {$label}")->eof();
    }
    
    $this->eof();
    $this->yellow("Escolha uma opção: ");
    $choice = $this->input("");
    
    return $choice;
  }

  /**
   * Solicita uma senha (entrada oculta - funciona apenas no Linux/Mac)
   * 
   * @param string $prompt Texto a ser exibido antes da entrada
   * @return string Senha digitada pelo usuário
   */
  public function password(
    string $prompt = "Senha: "
  ): string {
    $this->write($prompt);
    
    // Tenta desabilitar echo no terminal (Linux/Mac)
    if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
      system('stty -echo');
      $password = trim(fgets(STDIN));
      system('stty echo');
      $this->eof();
    } else {
      // No Windows, mostra a senha (limitação)
      $password = trim(fgets(STDIN));
    }
    
    return $password;
  }

  // ========== Progress & Spinner ==========

  /**
   * Exibe um frame de spinner/loading animado
   * 
   * Os frames disponíveis são: | / - \
   * Use em loop para criar animação de carregamento
   * 
   * @param int $frame Número do frame (0-3)
   * @param string $text Texto opcional para exibir ao lado do spinner
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function spinner(
    int $frame = 0,
    string $text = ""
  ): static {
    $frames = ["|", "/", "-", "\\"];
    $char = $frames[$frame % 4];
    
    $output = $text ? "{$char} {$text}" : $char;
    
    return $this->write("\r{$output}", true);
  }

  /**
   * Exibe um spinner com estilo de pontos animados
   * 
   * Os frames disponíveis são: ⠋ ⠙ ⠹ ⠸ ⠼ ⠴ ⠦ ⠧ ⠇ ⠏
   * 
   * @param int $frame Número do frame (0-9)
   * @param string $text Texto opcional para exibir ao lado do spinner
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function spinnerDots(
    int $frame = 0,
    string $text = ""
  ): static {
    $frames = ["⠋", "⠙", "⠹", "⠸", "⠼", "⠴", "⠦", "⠧", "⠇", "⠏"];
    $char = $frames[$frame % 10];
    
    $output = $text ? "{$char} {$text}" : $char;
    
    return $this->write("\r{$output}", true);
  }

  /**
   * Exibe um spinner com estilo de seta circular
   * 
   * Os frames disponíveis são: ← ↖ ↑ ↗ → ↘ ↓ ↙
   * 
   * @param int $frame Número do frame (0-7)
   * @param string $text Texto opcional para exibir ao lado do spinner
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function spinnerArrow(
    int $frame = 0,
    string $text = ""
  ): static {
    $frames = ["←", "↖", "↑", "↗", "→", "↘", "↓", "↙"];
    $char = $frames[$frame % 8];
    
    $output = $text ? "{$char} {$text}" : $char;
    
    return $this->write("\r{$output}", true);
  }

  /**
   * Exibe uma barra de progresso simples
   * 
   * @param int $current Valor atual do progresso
   * @param int $total Valor total/máximo
   * @param int $width Largura da barra em caracteres (padrão: 50)
   * @param string $char Caractere para preencher a barra (padrão: "=")
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function progressBar(
    int $current,
    int $total,
    int $width = 50,
    string $char = "="
  ): static {
    $percentage = ($current / $total) * 100;
    $filled = (int)(($current / $total) * $width);
    $empty = $width - $filled;
    
    $bar = str_repeat($char, $filled) . str_repeat(" ", $empty);
    $output = sprintf("\r[%s] %d%%", $bar, (int)$percentage);
    
    return $this->write($output, true);
  }

  /**
   * Exibe uma barra de progresso com informações detalhadas
   * 
   * @param int $current Valor atual do progresso
   * @param int $total Valor total/máximo
   * @param int $width Largura da barra em caracteres (padrão: 40)
   * @param string $prefix Texto antes da barra (padrão: "Progress")
   * @return static Retorna a própria instância para encadeamento de métodos
   */
  public function progressBarDetailed(
    int $current,
    int $total,
    int $width = 40,
    string $prefix = "Progress"
  ): static {
    $percentage = ($current / $total) * 100;
    $filled = (int)(($current / $total) * $width);
    $empty = $width - $filled;
    
    $bar = str_repeat("█", $filled) . str_repeat("░", $empty);
    $output = sprintf(
      "\r%s: [%s] %d/%d (%d%%)",
      $prefix,
      $bar,
      $current,
      $total,
      (int)$percentage
    );
    
    return $this->write($output, true);
  }

  // ========== Factory Method ==========

  /**
   * Cria uma nova instância da classe Terminal
   * 
   * Método estático que facilita a criação de instâncias para uso fluente.
   * Exemplo: Terminal::init()->green('Texto')->eof();
   * 
   * @return static Nova instância da classe Terminal
   */
  public static function init(
  ): static {
    return new static;
  }
}


