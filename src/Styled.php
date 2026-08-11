<?php

namespace Websyspro\Logger;

class Styled
{
  public function __construct(
    public readonly array $color,
    public readonly array $bgColor,
    public readonly bool $bold
  ){}
}