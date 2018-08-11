<h2>ついったーに参加しました。</h2>
<?php print($userid."さんはついったーに参加されました。") ?><br>
<?php print("ログインをクリックしログインしてつぶやいてください。") ?>
<?php print(
  $this->Form->create() .
  $this->Form->button('twitterにログインする', ['label' => 'twitterにログインする']).
  $this->Form->end()
); ?>