<?php

namespace App\Controller;

class PostsController extends AppController {

    //  ↓viewの自動読み込みを停止する
    //     public $autoRender = false;

    //     コントローラ初期化時に呼ばれるメソッド。親のクラスをオーバーライドしているので、リターンの型名であるvoidを書く
    public function initialize() :void
    {
        parent::initialize();
        // 別のレイアウトを読み込む
        $this->viewBuilder()->setLayout('test');
    }
    //public function index()
    {
        モデルには、$this->Postsでアクセスできる。find('all')ですべてのデータを取得する
        $posts = $this->Posts->find('all');
        //取得したデータを簡単に表示できる。
        //dd($posts->toArray());

//         setメソッドで、posts変数をビューにわたす。
        $this->set(compact('posts'));
    }
    public function view($id = null)
    {
//         記事の詳細を表示するので、1つだけ表示する。1つだけ表示するには、getメソッドを使う。

        $post = $this->Posts->get($id);
        $this->set(['post' => $post]);

        // $this->set(['id' => $id]); キーと変数名が同じ場合、以下のようにcompact関数で省略できる。
//         $this->set(compact('id', 'title'));

        //         default.phpのレイアウトを無効化する。
        //         $this->viewBuilder()->disableAutoLayout();

        // 基本的には、アクション名と同じビューファイルを呼び出すが、別のビューファイルを呼び出すこともできる。
        // 別のビューファイルを呼び出すと、元のファイルは表示されなくなる。
        // ディレクトリの階層が違う場合、/posts/indexのように書く
        // $this->render('index');
    }
}

?>