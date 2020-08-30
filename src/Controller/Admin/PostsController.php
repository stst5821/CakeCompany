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
use Cake\Event\Event; // 追加

class PostsController extends AppController
{
    public $paginate = [
        'limit' => 6,
        'order' => ['created' => 'desc'],
        'contain' => ['Users'] // Usersテーブルを結合する
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

        if (!$this->Posts->save($post)) {
            $this->Flash->error(__('投稿できませんでした。'));
        }

        
        $this->Flash->success(__('投稿しました！'));
        return $this->redirect(['action' => 'index']);
    }

    // viewメソッド

    public function view($id = null)
    {
        // $idを元に、DBから該当するデータを取得。この場合の$idには、URLパラメータ(View/1 の「1」の部分)が入る。
        // get($id)の$idは、URLパラメータを見に行っているので変更はしなくてよい。
        // Postsテーブルの$idの中身に該当するレコードを探しにいっている。
        // Postsテーブルのpost_idと$idを比較して該当するレコードをgetしているが、post_idと比較するという命令はどこでしている？
        if (empty($id)) {
            $this->redirect(['action' => 'index']);
            return;
        }
        $post = $this->Posts->find()->where([
            "Posts.id" => $id,
        ])->first();
        if (empty($post)) {
            $this->redirect(['action' => 'index']);
            return;
        }

        $this->set('post', $post);
    }

    // editメソッド

    public function edit($id = null)
    {
        //  管理者か、スタッフ自身が作った記事でなければ、indexにリダイレクトさせる。
        // if (!$this->Posts->get($id) == $this->Auth->user('id')) {
        //     return $this->redirect(['action' => 'index']);
        // }
        
        $query = $this->Posts->find()->where(["Posts.id" => $id]);
        //管理者じゃない場合は自分の投稿データのみ修正できるため条件を追加
        if (!IS_SUDO) {
            $query->where(["Posts.user_id" => $this->Auth->user('id')]);
        }
        $post = $query->first();
        
        if (empty($post)) {
            $this->redirect(['action' => 'index']);
            return;
        }
        
        if (!$this->request->is(['patch', 'post', 'put'])) {
            $this->set('post', $post);
            return;
        }
        
        $post = $this->Posts->patchEntity($post, $this->request->getData());

        if ($post->getErrors()) {
            $this->set('post', $post);
            return;
        }
            
        if ($this->Posts->save($post)) {
            $this->Flash->success(__('The user has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
        
    }
    

    // Delete メソッド

    public function delete($id = null)
    {
        //  スタッフログイン時、スタッフのidと投稿のpost_idを照合し、スタッフ自身が作った記事でなければ、indexにリダイレクトさせる。
        // if (!$this->Posts->get($id) == $this->Auth->user('id')) {
        //     return $this->redirect(['action' => 'index']);
        // }
        
        // getとdeleteのリクエストのみ受付。postだとエラーを出す。
        $this->request->allowMethod(['post', 'delete']);
        if (empty($id)) {
            $this->redirect(['action' => 'index']);
            return;
        }
        $post = $this->Posts->find()->where(["Posts.id" => $id])->first();
        if (empty($post)) {
            $this->redirect(['action' => 'index']);
            return;
        }

        if (!$this->Posts->delete($post)) {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        $this->Flash->success(__('削除できました。.'));
    
        return $this->redirect(['action' => 'index']);
    
    }
    }