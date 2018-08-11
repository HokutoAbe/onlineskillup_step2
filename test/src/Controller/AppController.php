<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
                'authorize' => ['Controller'],
                'authenticate'   => [ 'Form' => [ 'fields' => ['username' => 'userid', 'password' => 'password' ] ] ],
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'index'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ]
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    public function isAuthorized($user)
    {
      // 管理者はすべての操作にアクセスできます
      if ($this->Auth->user()) {
        return true;
      }

      // デフォルトは拒否
      return false;
    }
public function tweetCount($userid){
      $tweets = TableRegistry::get("tweets")->find()
                 ->select(['id'])
                 ->where(['userid =' => $userid])
                 ->count();
      return (int)$tweets;
    }
    public function getFollowingList($userid){
      return TableRegistry::get("followings")->find()
               ->select(['following_userid'])
               ->where(['userid = ' => $userid]);
    }

    public function getFollowedList($userid){
      return TableRegistry::get("followings")->find()
               ->select(['userid'])
               ->where(['following_userid = ' => $userid]);
    }
    public function beforeFilter(Event $event){
      parent::beforeFilter($event);
      //$this->Auth->allow();
      $this->set('user', $this->Auth->user());
      $userid = $this->Auth->user()['userid'];
    $followingList = $this->getFollowingList($userid);
    $followedList = $this->getFollowedList($userid);
    $followingNum = $followingList->count();
    $followedNum = $followedList->count();
    $this->set('followingNum', $followingNum);
    $this->set('followedNum', $followedNum);
    $this->set('myTweetCount',$this->tweetCount($userid));
      //$this->viewBuilder()->setLayout('main');
    }
    public function beforeRender(Event $event) {
        parent::beforeRender($event); //親クラスのbeforeRendorを呼ぶ
        $this->viewBuilder()->setLayout('main');
    }
    
}
