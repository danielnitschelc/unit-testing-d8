<?php

use Drupal\Core\Session\AccountProxy;
use Drupal\quadrupaler\Quadrupaler;

class QuadrupalerTest extends PHPUnit\Framework\TestCase {

  /** @var PHPUnit_Framework_MockObject_MockObject $accountProxy */
  private $accountProxy;

  public function setUp() {
    $this->accountProxy = $this->getMock(AccountProxy::class);
  }

  public function testQuadrupal_GivenOneDrupal_ReturnFourDrupals() {
    $quadrupaler = new Quadrupaler($this->accountProxy);
    $this->assertEquals('Drupaldrupaldrupaldrupal', $quadrupaler->quadrupal('drupal'));
  }

  public function testQuadrupal_GivenDRUPAL_ReturnDRUPAL() {
    $quadrupaler = new Quadrupaler($this->accountProxy);
    $this->assertEquals('DRUPAL', $quadrupaler->quadrupal('DRUPAL'));
  }

  public function testQuadrupal_GivenDrupalWithText_ReturnFourDrupalsWithText() {
    $quadrupaler = new Quadrupaler($this->accountProxy);
    $this->assertEquals('Adrupaldrupaldrupaldrupala', $quadrupaler->quadrupal('adrupala'));
  }

  public function testQuadrupal_GivenAuthenticatedUser_FirstCharUppercase() {
    $this->accountProxy
      ->method('isAnonymous')
      ->willReturn(FALSE);
    $quadrupaler = new Quadrupaler($this->accountProxy);
    $this->assertEquals('Drupaldrupaldrupaldrupal', $quadrupaler->quadrupal('drupal'));
  }

}
