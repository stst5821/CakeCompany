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
        'limit' => 5,
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
 
        // 送られてきたデータが、patch,post,putでなければ、実行
        if (!$this->request->is(['patch', 'post', 'put'])) {
            $this->set('contact', $contact);
            return;
        }

        $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

        // 未対応の場合は対応した管理者IDを空にする
        if($contact->flag == CONTACTS__FLAG__NOT_YET) {
            $contact->user_id = NULL;
        } 
        //対応済みの場合は対応した管理者のIDを現在のログインしている管理者のIDにする
        if($contact->flag == CONTACTS__FLAG__DONE) {
            $contact->user_id = $this->Auth->user('id');
        } 

        //エラーの場合は編集ページに戻す
        if ($contact->getErrors()) {
            $this->set('contact', $contact);
            return;
        }
        // セーブに成功しなかった場合も編集ページに戻す
        if (!$this->Contacts->save($contact)) {
            $this->Flash->error(__('例外的なエラーが起こり登録できませんでした。'));
            return;
        }
        $this->Flash->success(__('The contact has been saved.'));
        
        return $this->redirect(['controller' => 'Contacts', 'action' => 'index']);
    }

    // お問い合わせの検索
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    public function find() 
    { 
        $contacts = $this->paginate($this->Contacts->find()->where($this->generateConditions($this->request->query())));
        $this->set('contacts', $contacts);

        if (isset($this->request->data['csv'])) {
            
            // csvダウンロードが押された時は、ページネーションを外した状態で改めて検索する。
            // こうしないと、1ページ目しか取得できない。
            $contacts = $this->Contacts->find()->where($this->generateConditions($this->request->query()));
            
            $_serialize = 'contacts';
            $_header = ['id', 'customer_name', 'mail','body','received', 'modified','user_id','flag'];
            // 出力したいカラム名を指定
            $_extract = [
                'id',
                'customer_name',
                'mail',
                'body',
                'received',
                'modified',
                'user_id',
                'flag',
                ];

            $this->setResponse($this->getResponse()->withDownload('my-file.csv'));
            $this->viewBuilder()->className('CsvView.Csv');
            $this->set(compact('contacts', '_serialize', '_header', '_extract'));
        }
    }

    private function generateConditions($query)
    {
        $conditions = [];
        if (isset($query['flag']) && $query['flag'] != null) {
            $conditions['Contacts.flag'] = $query['flag'];
        }
         // フリーワード検索の設定
        if (isset($query['find']) && $query['find'] != null) {
            $conditions['OR']['Contacts.body like'] = "%{$query['find']}%";
            $conditions['OR']['Contacts.mail like'] = "%{$query['find']}%";
            $conditions['OR']['Contacts.customer_name like'] = "%{$query['find']}%";
        }
        return $conditions;
    }

    public function export() {
        $contacts = $this->Contacts->find('all');
        // クエリを指定する。
        $_serialize = 'contacts';
        $_header = ['id', 'customer_name', 'mail','body','received', 'modified','user_id','flag'];
        // 出力したいカラム名を指定
        $_extract = [
            'id',
            'customer_name',
            'mail',
            'body',
            'received',
            'modified',
            'user_id',
            'flag',
            ];

        // ダウンロード時のファイル名を指定する。
        $this->setResponse($this->getResponse()->withDownload('my-file.csv'));
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('contacts', '_serialize', '_header', '_extract'));
    }
}