<h1>ついったーに参加しましょう</h1>
<?php if($errors):?>
<div style="background-color: yellow;">
  <p>入力内容に誤りがあります。</p>
  <?php foreach($errors as $error):?>
    <?php foreach($error as $message):?>
      <?php print($message);?><br>
    <?php endforeach?>
  <?php endforeach?>
</div>
<?php endif;?>
<?php print(
  $this->Form->create() .
  $this->Form->control('username', ['label' => '名前']) .
  $this->Form->control('userid', ['label' => 'ユーザー名']) .
  $this->Form->control('password', ['label' => 'パスワード']) .
  $this->Form->control('passwordRe', ['label' => 'パスワード(確認用)','type' => 'password']) .
  $this->Form->control('mailaddress', ['label' => 'メールアドレス']) .
  $this->Form->checkbox('release', ['label' => 'つぶやきを非公開にする']) .
  'つぶやきを非公開にする<br>'.
  $this->Form->button('アカウントを作成する', ['label' => 'アカウントを作成する']).
  $this->Form->end()
); ?>