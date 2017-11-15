<?php

require_once 'Quadrupaler.php';

class QuadrupalerTest extends PHPUnit\Framework\TestCase {

  public function testQuadrupal_GivenOneDrupal_ReturnFourDrupals() {
    $quadrupaler = new Quadrupaler();
    $this->assertEquals('drupaldrupaldrupaldrupal', $quadrupaler->quadrupal('drupal'));
  }

  public function testQuadrupal_GivenDRUPAL_ReturnDRUPAL() {
    $quadrupaler = new Quadrupaler();
    $this->assertEquals('DRUPAL', $quadrupaler->quadrupal('DRUPAL'));
  }

  public function testQuadrupal_GivenDrupalWithText_ReturnFourDrupalsWithText() {
    $quadrupaler = new Quadrupaler();
    $this->assertEquals('adrupaldrupaldrupaldrupala', $quadrupaler->quadrupal('adrupala'));
  }

}