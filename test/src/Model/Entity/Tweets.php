<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

 
class Tweets extends Entity {
  //入力チェック機能
  
  protected $_accessible = [
        '*' => true,
        'id' => false
    ];
protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

}
?>