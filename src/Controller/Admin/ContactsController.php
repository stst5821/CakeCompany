<?php

namespace App\Controller\Admin;

/**
 * Users Controller
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use CakeORMTableRegistry;


class ContactsController extends AppController
{
    public $paginate = [
        'limit' => 6,
        'order' => ['received' => 'desc']
    ];

    public function initialize() {
        
        parent::initialize();
        
        // $this->loadModel("Contacts");
        $this->loadComponent('Paginator');
    }


    // お問い合わせの一覧
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function index()
    {

        // 管理者でない場合は、indexにリダイレクトさせる。
        // 管理者以外、このページは表示されないけど、あったほうがいいか？念の為、セキュリティ上？
        if (!IS_SUDO) {
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }
                
        // ページネーションを追加する。
        $contacts = $this->paginate($this->Contacts);
        $this->set('contacts', $contacts);
    }


    // お問い合わせの詳細
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    public function view($id = null)
    {

        $record_color = 'red';
        $this->set('contact', $record_color);

        // 管理者でない場合は、indexにリダイレクトさせる。
        if (!IS_SUDO) {
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }
        // contactsテーブルから$idを元に該当するデータを引っ張ってくる
        $contact = $this->Contacts->get($id,[
            'contain' => []
        ]);
        // ↑の$userをuser変数に入れてセットして、Viewで使えるようにする。
        $this->set('contact', $contact);

        // フォーム入力して送信後

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
 
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            
        }
        $this->set('contact', $contact);
    }

}