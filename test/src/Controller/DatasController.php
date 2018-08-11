<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DatasController extends AppController {  

  public function posts($name){
    // WHERE name = $name に対応
    $options = array('conditions' => array('name' => $name));
    // SELECT * FROM datas に対応
    $datas = TableRegistry::get("datas")->find();

    $this->set('datas', $datas);
    $this->set('name', $name);
  }

}
?>