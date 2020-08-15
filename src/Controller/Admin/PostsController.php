<?php

namespace App\Controller\Admin;

/**
 * Users Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use CakeORMTableRegistry;

class PostsController extends AppController
{
    public $paginate = [
        'limit' => 6
    ];

    public function initialize() {
        parent::initialize();
        
        $this->loadComponent('Paginator');
    }

    // 記事の一覧
    
    public function index()
    {
        // ページネーションを追加する。
        $posts = $this->paginate($this->Posts);

        $this->set('posts', $posts);

    }

    // 記事の投稿

    public function post($id = null)
    {
        // PostsTableを使うという宣言をする。
        $this->loadModel("Posts");
        // Postsテーブルで、NewEntityを使い空の入れ物を作る。
        $post = $this->Posts->newEntity();

        // postがなかったら、中身を実行。
        if (!$this->request->is('post')) {
        $this->set('post', $post);
        return;
        }
        // patchEntityにgetDataで取得したデータを入れる。
        $post = $this->Posts->patchEntity($post, $this->request->getData());

        if ($post->getErrors()) {
        $this->set('post', $post);
        return;
        }

        if ($this->Posts->save($post)) {
        $this->Flash->success(__('投稿しました！'));

        return $this->redirect(['controller' => 'Posts','action' => 'index']);
        }
        $this->Flash->error(__('投稿できませんでした。'));
    }

    // viewメソッド

    public function view($id = null)
    {
        // $idを元に、DBから該当するデータを取得。この場合の$idには、URLパラメータ(View/1 の「1」の部分)が入る。
        // get($id)の$idは、URLパラメータを見に行っているので変更はしなくてよい。
        // Postsテーブルの$idの中身に該当するレコードを探しにいっている。
        // Postsテーブルのpost_idと$idを比較して該当するレコードをgetしているが、post_idと比較するという命令はどこでしている？
        $post = $this->Posts->get($id);

        $this->set('post', $post);
    }

    // editメソッド

    public function edit($id = null)
    {
        $post = $this->Posts->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The user has been saved.'));
 
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set('post', $post);
    }

    // Delete メソッド

    public function delete($id = null)
    {
        // getとdeleteのリクエストのみ受付。postだとエラーを出す。
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('削除できました。.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
    
        return $this->redirect(['action' => 'index']);
    }
    
}