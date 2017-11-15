<?php

namespace Drupal\quadrupaler;

use Drupal\node\Entity\Node;

class NodeWrapper {

  public function load($nid) {
    return Node::load($nid);
  }

}
