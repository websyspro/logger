<?php

namespace Websyspro\Logger\Enums;

enum LogType: string {
  case module = "Module";
  case eervice = "Service";
  case entity = "Entity";
  case context = "Context";
  case controller = "Controller";
  case database = "Database";
  case import = "Import";
  case queryContext = "QueryContext";
}