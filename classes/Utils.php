<?php

class Utils
{
  public static function redirect(string $location): void
  {
    header('Location: ' . $location);
    exit;
  }
}
