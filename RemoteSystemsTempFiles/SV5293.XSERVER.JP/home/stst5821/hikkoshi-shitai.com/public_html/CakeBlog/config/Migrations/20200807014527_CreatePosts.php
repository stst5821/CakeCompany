<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePosts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('posts');
        $table
//                 カラムを追加する。addColumn('第一引数','データ型')

//                 記事のタイトル
                ->addColumn('title','string',[
                    'limit' => 150,
                    'null' => false
                ])
//                 記事の概要
                ->addColumn('description','text', [
                    'limit' => 255
                ])
//                 記事の本文
                ->addColumn('body', 'text')
//                 公開、非公開を決める
                ->addColumn('published', 'boolean',[
                    'default' => false // 初期値を設定
              ])

//                 データの登録日。投稿したときに自動で日付を入れてくれる。
                ->addColumn('created','datetime')
//                 データの変更日。変更した時に自動で日付を入れてくれる。
                ->addColumn('modified', 'datetime')

                ->create();
    }
}
