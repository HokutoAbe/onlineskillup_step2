<div style='width: 300px'>
<table style="background-color: #b0b0ff;">
  <tr>
    <td style="text-align: center;" colspan="3"><?php print($user['userid']);?></td>
  </tr>
  <tr>
    <td><?php print($followingNum);?></td>
    <td><?php print($followedNum);?></td>
    <td><?php print($myTweetCount);?></td>
  </tr>
  <tr>
    <td><?=$this->Html->link('フォローしている', '/users/following')?></td>
    <td><?=$this->Html->link('フォローされている', '/users/followed')?></td>
    <td><?=$this->Html->link('投稿数', ['controller'=>'Tweets','action'=> 'index','?' =>['userid'=>$user['userid']]])?></td>
  </tr>
</table>
</div>