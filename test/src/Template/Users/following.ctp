<h3><?php print($user['userid']."は".$followingNum)?>人フォローしています。</h3>

<div style="width :500px;float: left;">
  <p>ユーザー名　/　名前</p>
  <table border="1">
    <?php foreach($followingListPart as $user): ?>
      <tr>
        <?php print($this->Form->create())?>
          <td>
            <div style='float:left'>
            <?= $this->Html->link( $user['userid'], ['controller' => 'Tweets','action' => '/','?'=> ['userid' => $user['userid']]])?><br>
            <?php print(h($user["username"]))?><br>
            <?php $message  = mb_ereg_replace('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', '<a href="\1">\1</a>', h($user['latestTweet']['sentence']));?>
            <?php print($message)?><br>
            </div>
            <div align='right'>
              <?php print($this->Form->create())?>
              <?php print($this -> Form -> hidden ( "following_userid", [ "value" => $user['userid'] ] ) );?>    
              <?php print(($this->Form->button('follow解除') )) ?></td>
              <?php print($this->Form->end())?>
            </div>
          </td>
        <?php print($this->Form->end())?>
      </tr>
    <?php endforeach; ?>
  </table>
<?php if($page>1):?>
  <?= $this->Html->link( '<<前へ', ['?'=> $paramBefore], array('class' => 'button') )?>
<?php endif;?>
<?php if($page*10<$followingCount):?>
  <?= $this->Html->link( '次へ>>', ['?'=> $paramNext],['class' => 'button'])?>
<?php endif;?>
</div>

<div style="margin-left : 500px;margin-top : 0px">
  <?php print($this->element('righter'));?>
</div>
