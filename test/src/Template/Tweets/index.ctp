<h3>いまなにしてる?</h3>
<div  style="width :600px;">
  <?php if($paramUser==0):?>
  <div style="background-color: yellow;">
  
  <?php foreach($errors as $error):?>
    <?php foreach($error as $message):?>
      <?php print($message);?><br>
    <?php endforeach?>
  <?php endforeach?>
  </div>
  <?php print(
    $this->Form->create() .
    $this->Form->control('sentence',['label' => ''])
  ); ?>
  <p style="float: left;">
    <string>最近のつぶやき:</string>
     <?php if($latestTweet):?>
       <?php $message  = mb_ereg_replace('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', '<a href="\1">\1</a>', h($latestTweet['sentence']));?>
       <?php print($message)?><br>
       <?php print($latestTweet['created_time']->format('Y年m月d日h時i分s秒'))?>
     <?php endif;?>
  </p>
  <div align="right">
    <?php print(
      $this->Form->button('投稿する').
      $this->Form->end()
    ); ?>
  </div>
  <?php endif;?>
</div>
<h3>ホーム</h3>
<div style="width :600px;float: left">
  <table border="1">
    <?php foreach($tweetList as $tweet): ?>
    <tr>
        <td>
          <div style="float: left">
          <a href=<?php print('/test/tweets/list/?userid='.$tweet["userid"].'>'.$tweet["userid"])?></a>
          <?php $message  = mb_ereg_replace('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', '<a href="\1">\1</a>', h($tweet['sentence']));?>
          <?php print($message)?><br>
          <?php print($tweet['created_time']->format('Y年m月d日h時i分s秒'))?>
          </div>
          <?php if(strcmp($tweet['userid'],$user['userid']) == 0):?>
          <div align='right'>
              <?php print($this->Form->create())?>
                <?php print($this -> Form -> hidden ( "id", [ "value" => $tweet['id'] ] ) );?>
                <?php print($this -> Form -> hidden ( "userid", [ "value" => $tweet['userid'] ] ) );?>
                <?php print($this -> Form -> hidden ( "sentence", [ "value" => $tweet['sentence'] ] ) );?>
                <?php print($this -> Form -> hidden ( "created_time", [ "value" => $tweet['created_time'] ] ) );?>
                <?php print(($this->Form->button('つぶやき削除') )) ?></td>
              <?php print($this->Form->end())?>
          </div>
          <?php endif;?>
        </td>
    <tr>
    <?php endforeach; ?>
  </table>
<?php if($page>1):?>
  <?= $this->Html->link( '<<前へ', ['?'=> $paramBefore], array('class' => 'button') )?>
<?php endif;?>
<?php if($page*10<$tweetCount):?>
  <?= $this->Html->link( '次へ>>', ['?'=> $paramNext],['class' => 'button'])?>
<?php endif;?>
</div>

<div style="margin-left : 600px">
<?php print($this->element('righter'));?>
</div>