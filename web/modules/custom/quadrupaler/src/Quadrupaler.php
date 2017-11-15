<?php

namespace Drupal\quadrupaler;

use Drupal\Core\Session\AccountProxy;
use Drupal\node\Entity\Node;

class Quadrupaler {

  private $accountProxy;
  private $nodeWrapper;

  public function __construct(AccountProxy $accountProxy, NodeWrapper $nodeWrapper) {
    $this->accountProxy = $accountProxy;
    $this->nodeWrapper = $nodeWrapper;
  }

  public function quadrupal(string $string): string {
    $replacement = str_replace('drupal', 'drupaldrupaldrupaldrupal', $string);
    if (!$this->accountProxy->isAnonymous()) {
      $replacement = ucfirst($replacement);
    }
    return $replacement;
  }

  public function quadrupalNode(int $nodeId): ?Node {
    $node = $this->nodeWrapper->load($nodeId);
    if (!empty($node)) {
      $node->title->value = $this->quadrupal($node->title->value);
    }
    return $node;
  }

}
