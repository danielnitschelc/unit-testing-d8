<?php

namespace Drupal\quadrupaler;

use Drupal\Core\Session\AccountProxy;

class Quadrupaler {

  private $accountProxy;

  public function __construct(AccountProxy $accountProxy) {
    $this->accountProxy = $accountProxy;
  }

  public function quadrupal(string $string): string {
    $replacement = str_replace('drupal', 'drupaldrupaldrupaldrupal', $string);
    if (!$this->accountProxy->isAnonymous()) {
      $replacement = ucfirst($replacement);
    }
    return $replacement;
  }

}
