<?php

namespace Drupal\quadrupaler;

class Quadrupaler {

  public function quadrupal(string $string): string {
    return str_replace('drupal', 'drupaldrupaldrupaldrupal', $string);
  }

}
