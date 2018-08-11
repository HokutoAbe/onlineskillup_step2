<h1>ユーザー一覧</h1>
<div style="margin-left : 10px">


<table border="1">
  <?php foreach($userList as $user): ?>
  <tr>
  <?php print($this->Form->create())?>
  <?php print($this -> Form -> hidden ( "following_userid", [ "value" => $user['userid'] ] ) );?>
    <td><?php print(h($user["username"]))?></td>
    <td><?php print(($this->Form->button('フォロー') )) ?></td>
  
  <?php print($this->Form->end())?>
  </tr>
<?php endforeach; ?>
</table>
</div>