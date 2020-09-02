<aside id="mainimg">
    <img src="img/1.jpg" alt="" id="slide0">
    <img src="img/1.jpg" alt="" id="slide1">
    <img src="img/2.jpg" alt="" id="slide2">
    <img src="img/3.jpg" alt="" id="slide3">
</aside>
<div id="contents">

    <section id="new">
        <h2 id="newinfo_hdr" class="close">更新情報・お知らせ</h2>
        <dl id="newinfo">
            <?php foreach ($pages as $page): ?>
            <!-- createdには投稿時間も含まれているが、日付だけ表示したいので、
            i18nFormatでこのように記述すると日付だけ表示される。 -->
            <dt><?= h($page->created->i18nFormat('yyyy/MM/dd')) ?></dt>
            <dd><?= h($page->body) ?></dd>
            <?php endforeach; ?>
        </dl>

        <div class="paginator">
            <ul class="pagination">
                <li><?= $this->Paginator->first('<< ' . __('最初のページへ')) ?></li>
                <li><?= $this->Paginator->prev('< ' . __('前へ')) ?></li>
                <li><?= $this->Paginator->numbers() ?></li>
                <li><?= $this->Paginator->next(__('次へ') . ' >') ?></li>
                <li><?= $this->Paginator->last(__('最後へ') . ' >>') ?></li>
            </ul>
            <p>
                <?= $this->Paginator->counter(['format' => __(' {{page}} ページ目(全 {{pages}}ページ)')]) ?>
            </p>
        </div>

    </section>

    <section>

        <h2>テンプレートのご利用前に必ずお読み下さい</h2>

        <h3>利用規約のご案内</h3>
        <p>このテンプレートは、<a href="http://template-party.com/">Template Party</a>にて無料配布している『初心者向けホームページテンプレート
            tp_beginner3』です。必ずダウンロード先のサイトの<a href="http://template-party.com/read.html">利用規約</a>をご一読の上でご利用下さい。
        </p>
        <p><span class="color1">■<strong>HP最下部の著作表示『Web Design:Template-Party』は無断で削除しないで下さい。</strong></span><br>
            わざと見えなく加工する事も禁止です。</p>
        <p><span class="color1">■<strong>下部の著作を外したい場合は</strong></span><br>
            <a href="http://template-party.com/">Template-Party</a>の<a
                href="http://template-party.com/member.html">ライセンス契約</a>を行う事でHP下部の著作を外す事ができます。</p>

        <h3>小さい端末で見た場合の「更新情報・お知らせ」用の開閉ブロック用プログラム（openclose.js）について</h3>
        <p>当テンプレートの開閉ブロックパーツは<a
                href="http://www.crytus.co.jp/">有限会社クリタス様</a>提供のプログラムを使用しています。openclose.jsファイルは改変せずにご利用下さい。<br>
            また、当サイトのテンプレート以外に使いたいなど、「プログラムのみ」を使う場合は<a
                href="http://template-party.com/free_program/openclose_license.html">こちらの規約</a>をお守り下さい。</p>

        <h3>当テンプレートの詳しい使い方は</h3>
        <p><a href="company.html#about">こちらをご覧下さい。</a></p>

    </section>

</div>
<!--/contents-->