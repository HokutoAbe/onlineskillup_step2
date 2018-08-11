<h1>ツイート一覧</h1>
<div style="width :500px;float: left;">


<table border="1">
  <?php foreach($tweetList as $tweet): ?>
  <tr>
  <?php print($this->Form->create())?>

    <td><?php print(h($tweet["sentence"]))?><br>
<?php 
$timetwi = new DateTime($tweet['created_time']);
print($timetwi->format('Y年m月d日h時i分s秒'));?>


</td>
    
  
  <?php print($this->Form->end())?>
  
  <tr>
<?php endforeach; ?>
</table>
</div>

<div style="margin-left : 500px">
<?php print($this->element('righter'));?>
</div>