<h1><?php print(h($name)); ?>さんの投稿一覧</h1>
<?php foreach($datas as $data): ?>
  <?php print(h($data["id"]) . ' (' . h($data["Data"]["age"]) . ')'); ?>
<?php endforeach; ?>