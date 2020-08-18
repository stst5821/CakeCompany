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
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body id="top">

    <div id="container">

        <header>
            <h1 id="logo">
                <!-- ※1 ルーティングを使っていないので、冗長になっているのでは？ -->
                <a href="<?= $this->Url->build(['controller'=>'Pages', 'action'=>'index']); ?>" class="something">
                    <?= print $this->Html->image('logo.png'); ?>
                </a>
            </h1>

            <nav id="menubar">
                <ul>
                    <li>
                        <a href="<?= $this->Url->build(['controller'=>'pages', 'action'=>'company']); ?>"
                            class="something">COMPANY</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['controller'=>'pages', 'action'=>'service']); ?>"
                            class="something">SERVICE</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['controller'=>'pages', 'action'=>'recruit']); ?>"
                            class="something">RECRUIT</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['controller'=>'pages', 'action'=>'link']); ?>"
                            class="something">LINK</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>



    <!-- ここにViewの内容が表示される。 -->
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