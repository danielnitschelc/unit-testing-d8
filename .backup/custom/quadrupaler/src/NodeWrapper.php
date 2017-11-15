<?php

namespace Drupal\quadrupler;

use Drupal\node\Entity\Node;

class NodeWrapper {

  /** @var Node $node */
  private $node;

  public function load(int $nid) {
    return Node::load($nid);
  }

  public function setNode($node) {
    $this->node = $node;
  }

  public function getTitle($node) {
    return $this->node->getTitle();
  }

  public function setTitle($title) {
    $this->node->setTitle($title);
  }
}
