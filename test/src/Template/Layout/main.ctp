<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><?=$this->Html->link('twitter', '/tweets')?></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
              <?php if(isset($user)): ?>
                <li><?=$this->Html->link('ホーム', '/tweets')?></li>
                <li><?=$this->Html->link('友達を検索', '/users/search')?></li>
                <li><?=$this->Html->link('ログアウト', '/users/logout')?></li>
               
              <?php else: ?>
                <li><?=$this->Html->link('ログイン', '/users/login')?></li>
                <li><?=$this->Html->link('新規登録', '/users/add')?></li>
              <?php endif; ?>
                
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix" style = 'width: 1000px;margin: auto;'>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
