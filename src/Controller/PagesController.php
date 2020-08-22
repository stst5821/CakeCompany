<?php
namespace App\Controller;

/**
 * Users Controller
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\PostsTable $Users
 * @property \App\Model\Table\ContactsTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use CakeORMTableRegistry;
use Cake\Mailer\Email; // Emailクラスをロードする。


class PagesController extends AppController
{
    public $paginate = [
        'limit' => 6 ,
        'order' => ['created' => 'desc']
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        // $this->loadHelper('Paginator', ['templates' => 'paginator-templates']);
    }
    
    public function index()
    {
        // ページネーションを追加する。
        $this->loadModel('Posts');
        $pages = $this->paginate($this->Posts);

        // USERテーブルを全件検索して、$postsに代入。
        // $this->Pages->find('all')
        //          ↑ここは絶対にコントローラ名にしないといけない。この文は、Model/Table/pagesTableを見に行っている？
        $this->set('pages', $pages);
    }
    
    public function company()
    {
    }

    public function service()
    {
    }

    public function recruit()
    {
    }


    // お問い合わせ
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function contact()
    {
        $this->loadModel('Contacts');

        $contact = $this->Contacts->newEntity();
        $this->set('contact', $contact);

        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($contact->getErrors()) {
                $this->set('contact', $contact);
                return;
            }
            
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('ユーザーを登録しました。'));
 
                $email = new Email();
                $email->setProfile('ToSelf');

                $email->setFrom(['stst5821@gmail.com' => 'SampleCompany'])
                ->setTo('stst5821@gmail.com')
                ->setSubject('お問い合わせがありました。')
                ->send('本文');
                
                return $this->redirect(['action' => 'finish']);

            }
            $this->Flash->error(__('登録できませんでした。'));
        }
        $this->set('user', $contact);
    }


    public function finish()
    {
    }

    public function link()
    {
    }

}


?>