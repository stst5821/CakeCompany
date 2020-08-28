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
        // contactsモデルをロードする。
        $this->loadModel('Contacts');

        $contact = $this->Contacts->newEntity();

        // フォームからpostでデータが送らなかったらフォームをただ表示
        if (!$this->request->is('post')) {
            $this->set('contact', $contact);
            return;
        }

        $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
        
        // フォームからpostでデータが送られてきたらエラーチェック。エラーの場合はフォーム画面に戻す
        if ($contact->getErrors()) {
            $this->set('contact', $contact);
            return;
        }
        // セーブに成功しなかったら実行。getErrorsではDB内までチェックしないので、ここでDBに登録しようとしてエラーになる場合があるため
        // エラー処理をする必要がある。
        if (!$this->Contacts->save($contact)) {
            $this->Flash->error(__('例外的なエラーが起こり登録できませんでした。'));
            return;
        }
        $contact = $this->Contacts->get($contact->id);
        
        // DBにデータを登録できたら中を実行。
        $this->Flash->success(__('ユーザーを登録しました。'));
        
        $email = new Email();
        // config/app.phpでメール送信の設定をしている。
        $email->setProfile('ToSelf');

        // 会社宛てに送られるメール

        $email->setFrom(['stst5821@gmail.com' => 'SampleCompany'])
        ->setTo('stst5821@gmail.com')
        ->setTemplate("contact_for_admin")
        ->viewVars(["contact" => $contact])
        ->setSubject('お問い合わせがありました。')
        ->send();

        // 顧客（問合せした人）に送られるメール

        $email->setFrom(['stst5821@gmail.com' => 'SampleCompany'])
        ->setTo($contact['mail'])
        ->setTemplate("contact")
        ->viewVars(["contact" => $contact])
        ->setSubject('お問い合わせを受付ました。')
        ->send();
        
        // メール送信後、Contacts/finishにリダイレクトさせる。
        return $this->redirect(['action' => 'finish']);
    }


    public function finish()
    {
    }

    public function link()
    {
    }

}


?>