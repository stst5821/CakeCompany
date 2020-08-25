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
        'order' => ['received' => 'desc'],
        'contain' => ['Users']
    ];

    public function initialize() {
        
        parent::initialize();
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

        // 管理者でない場合は、indexにリダイレクトさせる。
        if (!IS_SUDO) {
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }

        // contactsテーブルから$idを元に該当するデータを引っ張ってくる
        // containオプションで、Usersテーブルと結合する。
        $contact = $this->Contacts->get($id,[
            'contain' => ['Users']
        ]);
        // ↑の$contactをuser変数に入れてセットして、Viewで使えるようにする。
        $this->set('contact', $contact);


        // フォームに入力して送信後の処理

        // 変更前のflagがdoneだったら実行

        if($contact['flag'] == CONTENTS__FLAG__DONE)
        {
            if ($this->request->is(['patch', 'post', 'put']))
            {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            // 変更後のflagがNOTYETだったら、user_idとmodifiedを削除
            // 間違ってdoneにしてしまい、user_idとmodifiedが入っても、またNOTYETに変えれば両方とも消せる。
            if($contact['flag'] == CONTENTS__FLAG__NOT_YET)
            {
                $contact['user_id'] = NULL;
                $contact['modified'] = NULL;
            }

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            
            }
            
        $this->set('contact', $contact);
        }

        // 変更前のflagがNotYetだったら実行

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            // flagが「NOTYET」だったら、modifiedとidを更新しない。
            // 理由：doneにした時だけ、対応者IDと氏名を入れたい。doneにした日時をmodifiedに登録したい。
            if($contact['flag'] == CONTENTS__FLAG__NOT_YET)
            {
                $contact->setDirty('modified', true);
                $contact['id'] = '';
            }

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            
        }
        $this->set('contact', $contact);
    }

    // お問い合わせの詳細
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    public function find() 
    {
        $contacts = [];

        if ($this->request->is('post')) {

            $find = $this->request->data['find'];
            $flag = $this->request->data['flag'];

            if(!$flag == '')
            {
            $contacts = $this->paginate($this->Contacts->find()
            ->where(['mail like' => '%' . $find . '%'])
            ->orwhere(['body like' => '%' . $find . '%'])
            ->orwhere(['customer_name like' => '%' . $find . '%'])
            ->where(['flag' => $flag])
            );
            }
            else
            {
            $contacts = $this->paginate($this->Contacts->find()
            ->where(['mail like' => '%' . $find . '%'])
            ->orwhere(['body like' => '%' . $find . '%'])
            ->orwhere(['customer_name like' => '%' . $find . '%'])
            );
            }

        }
            $this->set('msg', null);
                $this->set('contacts', $contacts);
        
    }

    }