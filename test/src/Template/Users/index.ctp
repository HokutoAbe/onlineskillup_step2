ログイン済み：<?php print(h($user['username'])); ?>さん<br />
<?php print($this->Html->link('ログアウト', ['action' => 'logout'])); ?>