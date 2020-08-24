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


//  Admin用 default.ctp
///////////////////////////////////////////////////////////////////////////////////////////


$cakeDescription = 'Sample Company';

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

    <?= $this->Html->css('slide.css') ?>
    <?= $this->Html->css('styleAdmin.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>


<!-- 現在ログイン中のusernameを表示している。PostsとUsersコントローラのinitializeに書いている。 -->
<?= $login_user ?>さん、ログイン中


<nav class="large-3 medium-4 columns" id="actions-sidebar">

    <ul class="side-nav">
        <li>
            <?= $this->Html->link(__('ログアウト'), ['controller' => 'Users','action' => 'logout']) ?>
        </li>
    </ul>



    <ul class="side-nav">
        <li>
            <!-- ユーザー一覧や追加の文字は、空白にして見えなくしても良いが、勉強中になので、わかりやすいように文字として残しておく。 -->
            <?php if (!IS_SUDO): ?>
            ユーザー一覧
            <?php else: ?>
            <?= $this->Html->link(__('ユーザー一覧'), ['controller' => 'Users','action' => 'index']) ?>
            <?php endif ?>
        </li>
        <li>
            <?php if (!IS_SUDO): ?>
            ユーザー追加
            <?php else: ?>
            <?= $this->Html->link(__('ユーザー追加'), ['controller' => 'Users','action' => 'add']) ?>
            <?php endif ?>
        </li>
    </ul>

    <ul class="side-nav">
        <li>
            <!-- お知らせを投稿する。UsersControllerに移動 -->
            <?= $this->Html->link(__('お知らせ一覧'), ['controller' => 'Posts','action' => 'index']) ?>
        </li>
        <li>
            <!-- お知らせを投稿する。UsersControllerに移動 -->
            <?= $this->Html->link(__('お知らせ投稿'), ['controller' => 'Posts','action' => 'post']) ?>
        </li>
    </ul>

    <ul class="side-nav">
        <li>
            <!-- お知らせを投稿する。UsersControllerに移動 -->
            <?= $this->Html->link(__('お問い合わせ一覧'), ['controller' => 'Contacts','action' => 'index']) ?>
        </li>
        <li>
            <!-- お知らせを投稿する。UsersControllerに移動 -->
            <?= $this->Html->link(__('お問い合わせ検索'), ['controller' => 'Contacts','action' => 'find']) ?>
        </li>
    </ul>

</nav>



<!-- ここにViewの内容が表示される。 -->
<?= $this->Flash->render('flash') ?>
<?= $this->fetch('content') ?>



<footer>
    <small>Copyright&copy; <a href="index.html">SAMPLE COMPANY</a> All Rights Reserved.</small>
    <span class="pr">《<a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a>》</span>
</footer>

<!--/container-->

<!--スマホ用更新情報　480px以下-->
<script type="text/javascript">
if (OCwindowWidth() <= 480) {
    open_close("newinfo_hdr", "newinfo");
}
</script>

</body>

</html>