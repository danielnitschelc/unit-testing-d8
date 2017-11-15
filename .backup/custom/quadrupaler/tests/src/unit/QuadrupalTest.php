<?php

use Drupal\Core\Session\AccountProxy;
use Drupal\node\Entity\Node;
use Drupal\quadrupaler\Quadrupal;
use Drupal\quadrupler\ExampleModel;
use Drupal\quadrupler\NodeWrapper;

class QuadrupalTest extends PHPUnit\Framework\TestCase {

  /** @var PHPUnit_Framework_MockObject_MockObject $accountProxy */
  private $accountProxy;
  /** @var PHPUnit_Framework_MockObject_MockObject $accountProxy */
  private $nodeWrapper;
  /** @var PHPUnit_Framework_MockObject_MockObject $accountProxy */
  private $exampleModel;

  public function setUp() {
    $this->accountProxy = $this->getMock(AccountProxy::class);
    $this->nodeWrapper = $this->getMock(NodeWrapper::class, ['load']);
    $this->exampleModel = $this->getMock(ExampleModel::class);
  }

  public function testQuadrupalText_givenOneDrupal_returnFourDrupal() {
    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
    $this->assertEquals('drupaldrupaldrupaldrupal', $quadrupal->quadrupalText('drupal'));
  }

  public function testQuadrupalText_givenDRUPAL_returnDRUPAL() {
    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
    $this->assertEquals('DRUPAL', $quadrupal->quadrupalText('DRUPAL'));
  }

//  public function testQuadrupalText_givenDrupalWithOtherText_returnFourDrupalWithOtherText() {
//    $quadrupal = new Quadrupal();
//    $this->assertEquals('adrupala', $quadrupal->quadrupalText('adrupaldrupaldrupala'));
//  }

  public function testQuadrupalText_givenAuthUser_dontReturnUcFirst() {
    $this->accountProxy
      ->method('isAnonymous')
      ->willReturn(FALSE);
    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
    $this->assertEquals('drupaldrupaldrupaldrupal', $quadrupal->quadrupalText('drupal'));
  }

  public function testQuadrupalText_givenAnonUser_returnUcFirst() {
    $this->accountProxy
      ->method('isAnonymous')
      ->willReturn(TRUE);
    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
    $this->assertEquals('Drupaldrupaldrupaldrupal', $quadrupal->quadrupalText('drupal'));
  }

  public function testQuadrupalNode_givenInvalidNid_returnNull() {
    $this->nodeWrapper
      ->method('load')
      ->willReturn(NULL);
    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
    $this->assertEquals(NULL, $quadrupal->quadrupalNode(1));
  }

//  public function testQuadrupalNode_givenDrupalInTitle_returnFourDrupalsIntitle() {
//    $node = (object) [
//      'title' => (object) [
//        'value' => 'drupal'
//      ]
//    ];
//    $expected = (object) [
//      'title' => (object) [
//        'value' => 'drupaldrupaldrupaldrupal'
//      ]
//    ];
//    $this->nodeWrapper
//      ->method('load')
//      ->willReturn($node);
//    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
//    $this->assertEquals($expected, $quadrupal->quadrupalNode(1));
//  }

//  public function testQuadrupalNode_givenDrupalInTitle_returnFourDrupalsIntitle() {
//    $node = Mockery::mock(Node::class);
//    $node
//      ->shouldReceive('get->getValue')
//      ->andReturn('drupal');
//    $node
//      ->shouldReceive('set')
//      ->withArgs(['title', 'drupaldrupaldrupaldrupal']);
//    $this->nodeWrapper
//      ->method('load')
//      ->willReturn($node);
//    $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $this->exampleModel);
//    $quadrupal->quadrupalNode(1);
//  }

    public function testQuadrupalNode_givenDrupalInTitle_returnFourDrupalsIntitle() {
      $node = Mockery::mock(Node::class);
      $model = Mockery::mock(ExampleModel::class);
      $model
        ->shouldReceive('setNode');
      $model
        ->shouldReceive('getNode')
        ->andReturn($node);
      $model
        ->shouldReceive('getTitle')
        ->andReturn('drupal');
      $model
        ->shouldReceive('setTitle')
        ->withArgs(['drupaldrupaldrupaldrupal']);
      $this->nodeWrapper
        ->method('load')
        ->willReturn($model);
      $quadrupal = new Quadrupal($this->accountProxy, $this->nodeWrapper, $model);
      $quadrupal->quadrupalNode(1);
    }

}
