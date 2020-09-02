<div id="contents">

    <section>

        <h2>COMPANY</h2>
        <p>このサイトの説明ページです。</p>

        <h2>tableサンプル</h2>
        <table class="ta1">
            <tr>
                <th colspan="2" class="tamidashi">見出しが必要な場合はここに入れます</th>
            </tr>
            <tr>
                <th>見出し</th>
                <td>ここに説明など入れて下さい。サンプルテキスト。</td>
            </tr>
            <tr>
                <th>見出し</th>
                <td>ここに説明など入れて下さい。サンプルテキスト。</td>
            </tr>
            <tr>
                <th>見出し</th>
                <td>ここに説明など入れて下さい。サンプルテキスト。</td>
            </tr>
            <tr>
                <th>見出し</th>
                <td>ここに説明など入れて下さい。サンプルテキスト。</td>
            </tr>
            <tr>
                <th>見出し</th>
                <td>ここに説明など入れて下さい。サンプルテキスト。</td>
            </tr>
            <tr>
                <th>見出し</th>
                <td>ここに説明など入れて下さい。サンプルテキスト。</td>
            </tr>
        </table>

    </section>

    <section id="about">

        <h2>当テンプレートについて</h2>

        <h3>当テンプレートはhtml5+CSS3(レスポンシブWEBデザイン)です</h3>
        <p>当テンプレートは、パソコン、スマホ、タブレットでhtml共通のレスポンシブWEBデザインになっております。<br>
            古いブラウザ（※特にIE8以下）で閲覧した場合にCSSの一部が適用されない（角を丸くする設定など）のでご注意下さい。</p>

        <h3>各デバイスごとのレイアウトチェックは</h3>
        <p>最終的なチェックは実際のタブレットやスマホで行うのがおすすめですが、臨時チェックは最新のブラウザ(IEならIE10以降)で行う事もできます。ブラウザの幅を狭くしていくと、各端末サイズに合わせたレイアウトになります。
        </p>
        <p>注意：cssはリアルタイムで反映されますが、javascript(js)は<span
                class="color1">ブラウザを再読み込み</span>させないと反映されないので、レイアウトが切り替わったらブラウザを再読み込みさせる事をおすすめします。javascriptは小さい端末用の開閉ブロックなどに使われています。
        </p>

        <h3>各デバイス用のスタイル変更は</h3>
        <p>cssフォルダのstyle.cssファイルで行って下さい。詳しい説明も入っています。<br>
            前半はパソコン環境を含めた全端末の共通設定になります。中盤以降、各端末向けのスタイルが追加設定されています。<br>
            media=&quot; (～)&quot;の「～」部分でcssを切り替えるディスプレイのサイズを設定しています。ここは必要に応じて変更も可能です。</p>

    </section>

    <section>

        <h2>当テンプレートの使い方</h2>

        <h3>titleタグ、copyright、metaタグ、他の設定</h3>
        <p><strong class="color1">■titleタグの設定はとても重要です。念入りにワードを選んで適切に入力しましょう。</strong><br>
            まず、htmlソースが見れる状態にして、上から６行目あたりにある、<br>
            <span class="look">&lt;title&gt;初心者向けホームページテンプレート tp_beginner3&lt;/title&gt;</span><br>
            を編集しましょう。<br>
            あなたのホームページ名が「SAMPLE COMPANY」だとすれば、<br>
            <span class="look">&lt;title&gt;SAMPLE COMPANY&lt;/title&gt;</span><br>
            とすればＯＫです。</p>
        <p><strong class="color1">■copyrightを変更しましょう。</strong><br>
            続いてhtmlの下の方にある、<br>
            <span class="look">Copyright&copy; SAMPLE COMPANY All Rights Reserved.</span><br>
            の「SAMPLE COMPANY」部分もあなたのサイト名に変更します。</p>
        <p><strong class="color1">■metaタグを変更しましょう。</strong><br>
            htmlソースが見える状態にしてmetaタグを変更しましょう。</p>
        <p>ソースの上の方に、<br>
            <span class="look">content=&quot;ここにサイト説明を入れます&quot;</span><br>
            という部分がありますので、テキストをサイトの説明文に入れ替えます。検索結果の文面に使われる場合もありますので、見た人が来訪したくなるような説明文を簡潔に書きましょう。</p>
        <p>続いて、その下の行の<br>
            <span class="look">content=&quot;キーワード１,キーワード２,～～～&quot;</span><br>
            も設定します。ここはサイトに関係のあるキーワードを入れる箇所です。10個前後ぐらいあれば充分です。キーワード間はカンマ「,」で区切ります。</p>
        <p><strong class="color1">■ロゴ画像のalt指定と、ロゴ画像本体も変更しましょう。</strong><br>
            html側に<br>
            <span class="look">&lt;img src=&quot;images/logo.png&quot; alt=&quot;SAMPLE COMPANY&quot;&gt;</span><br>
            となっている箇所があるので、ここのalt指定(SAMPLE COMPANY)もあなたのサイト名に変更しましょう。</p>
        <p>ロゴ画像本体については、baseフォルダに文字なしの土台画像「logo.png」が入っているので、画像ソフトなど使ってあなたのサイト名を入れて、imagesフォルダに上書きしましょう。このロゴ画像、HPで見るサイズよりかなり大きく感じると思いますが、高解像度の端末でピンボケさせない為に適当に大きくしてあります。
        </p>
        <p>レイアウト上のロゴの大きさは、cssフォルダのstyle.cssの<br>
            <spna class="color1">/*ヘッダー（ロゴが入った最上段のブロック）</spna><br>
            のブロックで設定されている、<br>
            <span class="color1">#logo img</span><br>
            にあるwidthの値で変更可能です。
        </p>

        <h3>ヘッダー部分をくっきり境界からなめらかなグラデーションにする場合</h3>
        <p>現在はくっきりと境界線が出ていますがグラデーションのスタイルを指定しているので簡単になめらかなグラデーションに変更もできます。<br>
            <a href="sample.html">具体的なサンプルはこちら。</a></p>

        <h3>その他、テンプレートのカラーやデザイン変更などは</h3>
        <p>cssフォルダのstyle.cssで行って下さい。詳しい解説も書かれています。<br>
            cssの解説は、「<span class="color1">/*</span>」と「<span class="color1">*/</span>」の間にコメントとして入れています。「<span
                class="color1">/*</span>」と「<span
                class="color1">*/</span>」はcss用のコメントタグであり、飾りではないので削除をしないで下さい。もし解説を削除したい場合は、「<span
                class="color1">/*</span>」と「<span class="color1">*/</span>」含めて丸ごと削除して下さい。</p>

        <h3>トップページのスライドショーについて</h3>
        <p><strong class="color1">■画像を入れ替えたい場合</strong><br>
            「image1.jpg」「image2.jpg」「image3.jpg」の３枚のjpg画像を用意してimagesフォルダに上書きして下さい。大きさはバラバラでも構いませんが、必ず「縦横比」を合わせて下さい。拡張子が「jpeg」や「JPG」と少し違った場合にうまく表示できないブラウザもあるので「jpg」で統一して下さい。「jpg」にできない場合はhtml側の拡張子指定を合わせてもらっても構いません。
        </p>
        <p><strong class="color1">■１回でループをストップさせたい場合</strong><br>
            現在、無限ループになっていますが１回や指定した回数でストップさせたい場合、cssフォルダのslide.cssの「実行する回数」に指定されている「infinite」を「1」に変更、「@keyframes
            slide3」の100%の「opacity: 0;」を「opacity: 1;」に変更して下さい。</p>
        <p><strong class="color1">■速度や枚数などの調整</strong><br>
            cssフォルダのslide.cssで行って下さい。解説も入っています。<br>
            <a href="http://template-party.com/tips/tips20160408_css_slide1.html">スライドショーに関する詳しい使い方はこちら。</a></p>
        <p><strong class="color1">■css3に対応した環境でしか動作しません。</strong><br>
            css3に対応していない古い環境（Internet Explorerだとバージョン9以下）から見た場合、最後の画像のみが固定表示される事になりますので考慮して用意して下さい。</p>
        <p><strong class="color1">■固定画像にしたい場合</strong><br>
            index.htmlのhtmlの上の方にある、<br>
            &lt;link rel=&quot;stylesheet&quot; href=&quot;css/slide.css&quot;&gt;<br>
            の１行を削除。<br>
            画像がすべて表示されるので、使わない画像を削除すればOKです。画像を囲っているasideタグなどはレイアウト設定が入っているので削除しないよう注意して下さい。</p>

        <h3>プレビューでチェックすると警告メッセージが出る場合(一部ブラウザ対象)</h3>
        <p>主にjavascript（jsファイル）ファイルによって出る警告ですが、WEB上では出ません。また、この警告が出ている間は効果を見る事ができないので、警告メッセージ内でクリックして解除してあげて下さい。これにより効果がちゃんと見れるようになります。
        </p>

        <h3>うまく編集できない場合は</h3>
        <p><a href="http://template-party.com/bbs/">サポート掲示板</a>からご質問下さい。対応可能な範囲内でサポートしております。</p>

    </section>

</div>
<!--/contents-->