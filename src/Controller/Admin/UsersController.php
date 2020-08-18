<?php
namespace App\Controller\Admin;

/**
 * Users Controller
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\PostsTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use CakeORMTableRegistry;

class UsersController extends AppController
{

    // ページネーション 表示数を決める
    public $paginate = [
        'limit' => 6
    ];

    public function initialize()
    {
        parent::initialize();
        // 認証しなくても表示できるページを指定する。

        // ページネーションのコンポーネントをロード
        $this->loadComponent('Paginator');
    }

    // indexメソッド
    //////////////////////////////////////////////////////////////////////////////////////////////

    
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set('users', $users);

        // 現在ログインしている人のレコードを取り出して、user変数にsetし、viewで使えるようにしている。
        // ログインしたときの情報をloginアクションのところで、$this->Auth->setUser($user);を使って事前に保管している。
        $this->set('user', $this->Auth->user('id'));
        
    }
    

    // viewメソッド
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function view($id = null)
    {
        // Usersテーブルから$idを元に該当するデータを引っ張ってくる
        $user = $this->Users->get($id);
        // ↑の$userをuser変数に入れてセットして、Viewで使えるようにする。
        $this->set('user', $user);
    }
 

    // addメソッド
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($user->getErrors()) {
                $this->set('user', $user);
                return;
            }
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーを登録しました。'));
 
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('登録できませんでした。'));
        }
        $this->set('user', $user);
    }

 
    // editメソッド
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function edit($id = null)
    {
        $this->set('user', $this->Auth->user('id'));

        
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
 
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            
        }
        $this->set('user', $user);
    }


    // Delete メソッド
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function delete($id = null)
    {
        // 許可するデータ受け取り方法を決める。
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('削除できました。.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
 
        return $this->redirect(['action' => 'index']);
    }

    // ログインフォーム
    //////////////////////////////////////////////////////////////////////////////////////////////
    

    public function login()
    {

        // default.ctpを無効化する。
        // ログイン画面にdefault.ctpを適用するとユーザー管理や投稿管理へのリンクなどの
        // ヘッダーが表示されてしまうため無効化している。
        $this->layout = '';
        
        // postでなければ、returnして次のコードに進む。こうすることでif文のネストを浅くできる。
        if (!$this->request->is('post')) {
            return;
        }
        
        $user = $this->Auth->identify();
        
        if ($user) {
            
            // ログイン時にユーザー情報を保存しておく。こうすることでログイン状態を保持している。
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('ユーザー名かパスワードが違います。'));
    }


    // ログアウト
    //////////////////////////////////////////////////////////////////////////////////////////////

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}