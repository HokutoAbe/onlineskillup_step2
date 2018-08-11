<h1>ログイン</h1>
<div style="background-color: yellow;">
  
 
    <?php foreach($errors as $message):?>
      <?php print($message);?><br>
    <?php endforeach?>
  
</div>
<?php print(
  $this->Form->create() .
  $this->Form->control('userid', ['label' => 'ユーザー名']) .
  $this->Form->control('password', ['label' => 'パスワード']) .
  $this->Form->button('ログイン').
  $this->Form->end()
); ?>