<?php

namespace Websyspro\Logger\Enums;

enum LogType: string {
  case Service = "Service";
  case Entity = "Entity";
  case Context = "Context";
  case Controller = "Controller";
  case Database = "Database";
  case Import = "Import";
  case QueryContext = "QueryContext";
}