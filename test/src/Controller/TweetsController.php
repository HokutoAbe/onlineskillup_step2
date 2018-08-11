<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class TweetsController extends AppController {
  
  //どのアクションが呼ばれてもはじめに実行される関数
  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    //$this->set('user', $this->Auth->user());
  }
  public function getLatestTweet($userid){
    $latestTweet = TableRegistry::get("tweets")->find()
                 ->where(['userid = ' => $userid])
                 ->order(['created_time' => 'desc'])->first();
    return $latestTweet;
  }
  public function beforeRender(Event $event) {
    parent::beforeRender($event); 
  }
  
  
  public function index(){    
    $tweet = $this->Tweets->newEntity();
    $tweet->userid = $this->Auth->user()['userid'];
    $tweet->created_time = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
    
    $userid = $this->Auth->user()['userid'];

    $latestTweet = $this->getLatestTweet($userid);

    $this->set('latestTweet',$latestTweet);

    $followers = TableRegistry::get("followings")->find()
                 //->select(['following_userid'])
                 ->where(['userid = ' => $userid]);

    $tweetList =array();
    $tempList =array();

    $param = $this->request->getQuery();
    $paramUser = 0;
    if( array_key_exists('userid', $param) ){
      $paramUser = 1;
      $tweets = TableRegistry::get("tweets")->find()                 
                 ->where(['userid =' => $param['userid']]);
      foreach($tweets as $twe){
        $tempList[] = $twe;
      }
    }else{
      
      $tweets = TableRegistry::get("tweets")->find()                 
                 ->where(['userid =' => $userid]);
      foreach($tweets as $twe){
        $tempList[] = $twe;
      }
      foreach($followers as $follower){
        $tweets = TableRegistry::get("tweets")->find()
                 //->select(['sentence'])
                 ->where(['userid =' => $follower['following_userid']]);
        foreach($tweets as $twe){
          $tempList[] = $twe;
        }
      }
    }

    $this->set('paramUser',$paramUser);

    if($tempList){
      foreach($tempList as $key => $val){
        //updatedでソートする準備
        $updated[$key] = $val["created_time"];
      }
      //配列のkeyのupdatedでソート
      array_multisort($updated, SORT_DESC, $tempList);
    }
    $page = 1;
    $tweetCount = count($tempList);
    
    
    if($this->request->is('get')){
      $page = (int)$this->request->getQuery('page');
    }
    
    if($page<1){
      $page=1;
    }
    for($i = ($page-1)*10; $i < ($page)*10 && $i < $tweetCount; $i++ ){
      $tweetList[] = $tempList[$i];
    }
    $this->set('tweetList',$tweetList);
    $this->set('page',$page);
    $this->set('tweetCount',$tweetCount);


    $paramBefore = $this->request->getQuery();
    $paramBefore['page'] = $page-1;
    $paramNext = $this->request->getQuery();
    $paramNext['page'] = $page+1;

    $this->set('paramBefore',$paramBefore);
    $this->set('paramNext',$paramNext);

    $errors = [];
    $postData = $this->request->getData();
    if($this->request->is('post')){
         debug($postData);
        if(array_key_exists('id', $postData)){
          $let = ['id' => $postData['id']];
          $Tweets = TableRegistry::get("tweets");
          if ($Tweets->deleteAll($let)) {
            $this->redirect(['action' => 'index']);
          }
        }else{
          $tweet = $this->Tweets->newEntity();
          $tweet['userid'] = $userid;
          $tweet['created_time'] = new Time(Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss'));
          $tweet = $this->Tweets->patchEntity($tweet, $this->request->getData());
          if($this->Tweets->save($tweet)){
            $this->redirect(['action' => 'index','?' => $param]);
          }
          $errors = $tweet->getErrors();
        }
     }
     $this->set('errors',$errors);
  }

  public function list(){
    $userid = $this->Auth->user()['userid'];
    $tweetList = TableRegistry::get("tweets")->find()
                 ->where(['userid = ' => $userid])
                 ->order(['created_time' => 'DESC']);
    $timenow = new Time(Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss'));
    
    $this->set('tweetList',$tweetList);
    $this->set('timenow',$timenow);   
  }


  public function addTweet(){
  
  }
}
?>