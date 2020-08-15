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

    public function index()
    {

    }

    public function view($id = null)
    {
           $title = 'VIEW.php';

//         default.phpのレイアウトを無効化する。
//         $this->viewBuilder()->disableAutoLayout();


          // $this->set(['id' => $id]); キーと変数名が同じ場合、以下のようにcompact関数で省略できる。
           $this->set(compact('id', 'title'));

          // 基本的には、アクション名と同じビューファイルを呼び出すが、別のビューファイルを呼び出すこともできる。
          // 別のビューファイルを呼び出すと、元のファイルは表示されなくなる。
          // ディレクトリの階層が違う場合、/posts/indexのように書く
          // $this->render('index');
    }
}

?>