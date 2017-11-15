<?php

namespace Drupal\quadrupler;

class ExampleModel {

  /** @var \Drupal\node\Entity\Node $node */
  private $node;

  public function setNode($node) {
    $this->node = $node;
  }

  public function getNode() {
    return $this->node;
  }

  public function getTitle() {
    $this->node->getTitle();
  }

  public function setTitle($title) {
    $this->node->setTitle($title);
  }

}
