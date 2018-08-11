
<div style="width :500px;float: left;">
  <?php if($param==0):?>
    <h3>友達を見つけて、フォローしましょう!<h3>
    <p>ついったーに登録済みの友達を検索できます。<p>
    <?php print(
      $this->Form->create('search',['type' => 'get']) .
      $this->Form->control('query', ['label' => '誰を検索しますか?','style'=>'width:400px;float: left']) .
      $this->Form->button('検索').
      $this->Form->end()
); ?>
    <p>ユーザー名や名前で検索<p>
  <?php else:?>
  <p><?php print($query)?>の検索結果:<p>
  <?php print(
  $this->Form->create('search',['type' => 'get']) .
  $this->Form->control('query', ['label' => '','style'=>'width:400px;float: left']) .
  $this->Form->button('検索').
  $this->Form->end()
); ?>
<p>ユーザー名や名前で検索<p>
  <?php if(count($matchListPart)==0):?>
  <font color='red'>対象のユーザーはみつかりません。</font>
  <?php endif;?>
  <table border="1">
    <?php foreach($matchListPart as $user): ?>
      <tr>
        
          <td>
            <div style='float:left'>
            <?= $this->Html->link( $user['userid'], ['controller' => 'Tweets','action' => '/','?'=> ['userid' => $user['userid']]])?><br>
            <?php print(h($user["username"]))?><br>
            <?php print(h($user["latestTweet"]["sentence"]))?>
          </div>
          <div align='right'>
            <?php if($user['isFollow']==0): ?>
            <?php print($this->Form->create())?>
              <?php print($this -> Form -> hidden ( "following_userid", [ "value" => $user['userid'] ] ) );?>    
              <?php print(($this->Form->button('follow') )) ?></td>
            <?php print($this->Form->end())?>
            <?php endif;?>
          </div>
          </td>
        
      </tr>
    <?php endforeach; ?>
  </table>
<?php if($page>1):?>
  <?= $this->Html->link( '<<前へ', ['?'=> $paramBefore], array('class' => 'button') )?>
<?php endif;?>
<?php if($page*10<$matchCount):?>
  <?= $this->Html->link( '次へ>>', ['?'=> $paramNext],['class' => 'button'])?>
<?php endif;?>
  <?php endif;?>
</div>

<div style="margin-left : 500px;margin-top : 0px">
  <?php print($this->element('righter'));?>
</div>
