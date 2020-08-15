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
    public $paginate = [
        'limit' => 6
    ];

    public function initialize()
    {
        parent::initialize();
        // 認証しなくても表示できるページを指定する。
        $this->Auth->allow([
            'add',
            'login',
        ]);

        $this->loadComponent('Paginator');
    }

    // indexメソッド

    public function index()
    {
        $users = $this->paginate($this->Users);
 
        $this->set('users', $users);
    }
    
    // viewメソッド

    public function view($id = null)
    {
        $user = $this->Users->get($id);
 
        $this->set('user', $user);
    }
 
    // addメソッド

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

    public function edit($id = null)
    {
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
 
    public function login()
    {
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
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

   
 
}