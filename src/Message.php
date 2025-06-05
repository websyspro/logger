<?php

namespace Websyspro\Logger;

use Websyspro\Logger\Enums\LogType;

class Message
{
  public static function Infors(
    LogType $logType,
    string $logText    
  ): bool {
    return Log::Message($logType, $logText);
  }

  public static function Error(
    LogType $logType,
    string $logText    
  ): bool {
    return Log::Error($logType, $logText);
  }
}