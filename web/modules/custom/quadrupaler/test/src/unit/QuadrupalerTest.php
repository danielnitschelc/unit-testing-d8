<?php

use Drupal\Core\Session\AccountProxy;
use Drupal\quadrupaler\Quadrupaler;
use Drupal\quadrupaler\NodeWrapper;

class QuadrupalerTest extends PHPUnit\Framework\TestCase {

  /** @var PHPUnit_Framework_MockObject_MockObject $accountProxy */
  private $accountProxy;
  /** @var PHPUnit_Framework_MockObject_MockObject $accountProxy */
  private $nodeWrapper;

  public function setUp() {
    $this->accountProxy = $this->getMock(AccountProxy::class);
    $this->nodeWrapper = $this->getMock(NodeWrapper::class, ['load']);
  }

  public function testQuadrupal_GivenOneDrupal_ReturnFourDrupals() {
    $quadrupaler = new Quadrupaler($this->accountProxy, $this->nodeWrapper);
    $this->assertEquals('Drupaldrupaldrupaldrupal', $quadrupaler->quadrupal('drupal'));
  }

  public function testQuadrupal_GivenDRUPAL_ReturnDRUPAL() {
    $quadrupaler = new Quadrupaler($this->accountProxy, $this->nodeWrapper);
    $this->assertEquals('DRUPAL', $quadrupaler->quadrupal('DRUPAL'));
  }

  public function testQuadrupal_GivenDrupalWithText_ReturnFourDrupalsWithText() {
    $quadrupaler = new Quadrupaler($this->accountProxy, $this->nodeWrapper);
    $this->assertEquals('Adrupaldrupaldrupaldrupala', $quadrupaler->quadrupal('adrupala'));
  }

  public function testQuadrupal_GivenAuthenticatedUser_FirstCharUppercase() {
    $this->accountProxy
      ->method('isAnonymous')
      ->willReturn(FALSE);
    $quadrupaler = new Quadrupaler($this->accountProxy, $this->nodeWrapper);
    $this->assertEquals('Drupaldrupaldrupaldrupal', $quadrupaler->quadrupal('drupal'));
  }

  public function testQuadrupal_GivenInvalidNodeId_ReturnNull() {
    $this->nodeWrapper
      ->method('load')
      ->willReturn(NULL);
    $quadrupaler = new Quadrupaler($this->accountProxy, $this->nodeWrapper);
    $this->assertEquals(NULL, $quadrupaler->quadrupalNode(-1));
  }

  public function testQuadrupal_GivenValidNodeWithDrupalIntitle_ReturnNodeWithFourDrupalsInTitle() {
    $node = (object) [
      'title' => (object) [
        'value' => 'drupal'
      ]
    ];
    $expected = (object) [
      'title' => (object) [
        'value' => 'Drupaldrupaldrupaldrupal'
      ]
    ];
    $this->nodeWrapper
      ->method('load')
      ->willReturn($node);
    $quadrupaler = new Quadrupaler($this->accountProxy, $this->nodeWrapper);
    $this->assertEquals($expected, $quadrupaler->quadrupalNode(1));
  }

}
