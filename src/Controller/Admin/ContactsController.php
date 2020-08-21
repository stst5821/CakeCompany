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

class ContactsController extends AppController
{
    public $paginate = [
        'limit' => 6,
        'order' => ['created' => 'desc'],
    ];

    public function initialize() {
        parent::initialize();
        $this->loadModel("Contacts");
        $this->loadComponent('Paginator');
        
        // default.ctpに現在ログインしているユーザー名を表示するため、ログイン中ユーザーのusernameをセットしている。

    }

    // 記事の一覧
    public function index()
    {

        // 管理者でない場合は、indexにリダイレクトさせる。
        if (!IS_SUDO) {
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }
                
        // ページネーションを追加する。
        $contacts = $this->paginate($this->Contacts);
        $this->set('contacts', $contacts);
    }

}