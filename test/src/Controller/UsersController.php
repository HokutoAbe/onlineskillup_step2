<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    
    $this->Auth->allow('add', 'logout');
  }

  public function beforeRender(Event $event) {
    parent::beforeRender($event); //親クラスのbeforeRendorを呼ぶ
        //$this->viewBuilder()->setLayout('main');
  }
  public function getLatestTweet($userid){
    $latestTweet = TableRegistry::get("tweets")->find()
                 ->where(['userid = ' => $userid])
                 ->order(['created_time' => 'desc'])->first();
    return $latestTweet;
  }
  //ログイン後にリダイレクトされるアクション
  public function index(){
    $this->set('user', $this->Auth->user());
  }
  
  public function add(){
  
    $user = $this->Users->newEntity();
    
    $errors=[];
      if($this->request->is('post')){
        
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if($this->Users->save($user)){          
          $this->set('user', $user);
          $this->Auth->setUser($user);
          $this->redirect(['action' => 'added','userid'=>$user['userid']]);
        }
        $errors = $user->getErrors();
      }
    $this->set('errors',$errors);
  }

  public function added(){
    $userid = $this->request->getQuery('userid');
    $this->set('userid', $userid);
    if($this->request->is('post')){
      $this->redirect(['action' => 'login']);
    }
  }


  public function login(){
    $errors=[];
    if($this->request->is('post')) {
      $user = $this->Auth->identify();
      $userData = $this->request->getData();
      if($userData['userid']==''){
        $errors[]="ユーザー名を入力してください。";
      }
      if($userData['password']==''){
        $errors[]="パスワードを入力してください。";
      }
      if($errors==[]&&!$user){
        $errors[]="ユーザー名かパスワードが違います。";
      }
      
      if ($user) {
        $this->Auth->setUser($user);
        return $this->redirect(['controller'=>'Tweets','action' => 'index']);
      }
    }
    $this->set('errors',$errors);
  }
  
  public function logout(){
    $this->Auth->logout();
    $this->redirect(['action' => 'login']);
  }

  public function following(){
    $userid = $this->Auth->user()['userid'];
    $tempList = $this->getFollowingList($userid);
    $followingList = [];
    $users = TableRegistry::get("users")->find();
    foreach($tempList as $follow){
      $folower = [];
      foreach($users as $user){
        if(strcmp($user['userid'],$follow['following_userid']) == 0){
          $follower = $user;
        }
      }
      $follower["latestTweet"] = $this->getLatestTweet($follower["userid"]);
      $followingList[] = $follower;
    }
    if($followingList){
      foreach($followingList as $key => $val){
        //updatedでソートする準備
        $updated[$key] = $val["created_time"];
      }
      //配列のkeyのupdatedでソート
      array_multisort($updated, SORT_DESC, $followingList);
    }
    $page = 1;
    $followingCount = count($followingList);
    $followingListPart = [];
    if($this->request->is('get')){
      $page = (int)$this->request->getQuery('page');
    }    
    if($this->request->is('post')) {
      $postData = $this->request->getData();
      $param = ['userid' => $userid,'following_userid' => $postData['following_userid']];
      $Followings = TableRegistry::get("followings");
      if ($Followings->deleteAll($param)) {
        $this->redirect(['action' => 'following']);
      }
    }

    if($page<1){
      $page=1;
    }
    for($i = ($page-1)*10; $i < ($page)*10 && $i < $followingCount; $i++ ){
      $followingListPart[] = $followingList[$i];
    }
    
    $paramBefore = $this->request->getQuery();
    $paramBefore['page'] = $page-1;
    $paramNext = $this->request->getQuery();
    $paramNext['page'] = $page+1;

    $this->set('page',$page);
    $this->set('followingCount',$followingCount);    
    $this->set('followingListPart', $followingListPart);
    $this->set('paramBefore',$paramBefore);
    $this->set('paramNext',$paramNext);
  }

  public function followed(){
    $userid = $this->Auth->user()['userid'];
    $tempList = $this->getFollowedList($userid);
    $followedList = [];
    $users = TableRegistry::get("users")->find();
    foreach($tempList as $follow){
      $folower = [];
      foreach($users as $user){
        if(strcmp($user['userid'],$follow['userid'])==0){
          $follower = $user;
        }
      }

      $follower["latestTweet"] = $this->getLatestTweet($follower["userid"]);
      $followedList[] = $follower;
    }
    if($followedList){
      foreach($followedList as $key => $val){
        //updatedでソートする準備
        $updated[$key] = $val["created_time"];
      }
      //配列のkeyのupdatedでソート
      array_multisort($updated, SORT_DESC, $followedList);
    }
    $page = 1;
    $followedCount = count($followedList);
    $followedListPart = [];
    if($this->request->is('get')){
      $page = (int)$this->request->getQuery('page');
    }    
    if($page<1){
      $page=1;
    }
    for($i = ($page-1)*10; $i < ($page)*10 && $i < $followedCount; $i++ ){
      $followedListPart[] = $followedList[$i];
    }
    
    $paramBefore = $this->request->getQuery();
    $paramBefore['page'] = $page-1;
    $paramNext = $this->request->getQuery();
    $paramNext['page'] = $page+1;

    $this->set('page',$page);
    $this->set('followedCount',$followedCount);    
    $this->set('followedListPart', $followedListPart);
    $this->set('paramBefore',$paramBefore);
    $this->set('paramNext',$paramNext);
  }

  public function search(){
    $userList = TableRegistry::get("users")->find()
                ->select();
    $matchList = [];
    $query = "";
    $param = 1;
    if($this->request->is('get')){
      $query = $this->request->getQuery('query');
    }

    if(is_null($query)){
      $param=0;
    }
    $this->set('param',$param);
    $this->set('query',$query);
    $userid = $this->Auth->user()['userid'];
    foreach($userList as $user){
      $match = preg_match('/^(.?)*'.$query.'(.?)*$/', $user['userid']) || preg_match('/^(.?)*'.$query.'(.?)*$/', $user['username']);
      if($match && strcmp($user['userid'] ,$userid) != 0){
        $user['latestTweet'] = $this->getLatestTweet($user["userid"]);
        $isFollow = TableRegistry::get("followings")->find()
                    ->where(['userid' => $userid])
                    ->where(['following_userid' => $user['userid']])
                    ->count();
        $user['isFollow'] = 0;
        if($isFollow){
          $user['isFollow'] = 1;
        }
        $matchList[] = $user;
      }
    }

    if($matchList){
      foreach($matchList as $key => $val){
        //updatedでソートする準備
        $updated[$key] = $val["created_time"];
      }
      //配列のkeyのupdatedでソート
      array_multisort($updated, SORT_DESC, $matchList);
    }
    $page = 1;
    $matchCount = count($matchList);

    $matchListPart = [];
    if($this->request->is('get')){
      $page = (int)$this->request->getQuery('page');
    }    

    if($page<1){
      $page=1;
    }
    for($i = ($page-1)*10; $i < ($page)*10 && $i < $matchCount; $i++ ){
      $matchListPart[] = $matchList[$i];
    }
    
    $paramBefore = $this->request->getQuery();
    $paramBefore['page'] = $page-1;
    $paramNext = $this->request->getQuery();
    $paramNext['page'] = $page+1;

    $this->set('page',$page);
    $this->set('matchCount',$matchCount);    
    $this->set('matchListPart', $matchListPart);
    $this->set('paramBefore',$paramBefore);
    $this->set('paramNext',$paramNext);


    
    if($this->request->is('post')){
      $Followings = TableRegistry::get("followings");
      $following = $Followings->newEntity();
      $following->userid = $this->Auth->user()['userid'];
      $following->following_time = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
      $following = $Followings->patchEntity($following, $this->request->getData());
      if($Followings->save($following)){
        $this->redirect(['action' => 'search','?' => $this->request->getQuery()]);
      }
      
    }
    $this->set('matchList',$matchList);
  }
  
}
?>