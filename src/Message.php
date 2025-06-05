<?php

namespace Websyspro\Logger;

use Websyspro\Logger\Enums\LogType;

class Message
{
  public static function Infors(
    LogType $logType,
    string $logText    
  ): void {
    Log::Message(
      $logType, 
      $logText
    );
  }

  public static function Error(
    LogType $logType,
    string $logText    
  ): void {
    Log::Error(
      $logType, 
      $logText
    );
  }
}