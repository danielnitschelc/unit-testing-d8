<?php

namespace Drupal\quadrupaler;

use Drupal\Core\Session\AccountProxy;
use Drupal\node\Entity\Node;
use Drupal\quadrupler\ExampleModel;
use Drupal\quadrupler\NodeWrapper;

class Quadrupal {

  private $accountProxy;
  private $nodeWrapper;
  private $exampleModel;

  public function __construct(AccountProxy $accountProxy, NodeWrapper $nodeWrapper, ExampleModel $exampleModel) {
    $this->accountProxy = $accountProxy;
    $this->nodeWrapper = $nodeWrapper;
    $this->exampleModel = $exampleModel;
  }

  public function quadrupalNode(int $nodeId): ?Node {
    /** @var Node $node */
    $node = $this->nodeWrapper->load($nodeId);
    if (!empty($node)) {
//      $node->title->value = $this->quadrupalText($node->title->value);
//      $node->set('title', $this->quadrupalText($node->get('title')->getValue()));
      $this->exampleModel->setNode($node);
      $this->exampleModel->setTitle(
        $this->quadrupalText($this->exampleModel->getTitle())
      );
      $node = $this->exampleModel->getNode();
    }
    return $node;
  }

  public function quadrupalText(string $string): string {
    $replacement = str_replace('drupal', 'drupaldrupaldrupaldrupal', $string);
    if ($this->accountProxy->isAnonymous()) {
      $replacement = ucfirst($replacement);
    }
    return $replacement;
  }

}
