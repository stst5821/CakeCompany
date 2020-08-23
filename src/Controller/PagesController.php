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

                // pr($contact['customer_name']);
                // exit;
                
                $email = new Email();
                $email->setProfile('ToSelf');

                $body_customer = 'お問い合わせを受け付けました。'
                        ."\n\n\n".
                        '氏名：'.$contact['customer_name']
                        ."\n".
                        'メールアドレス：'.$contact['mail']
                        ."\n".
                        'お問合せ内容：'.$contact['body']
                        ."\n".
                        '問合せ日時：'.$contact['modified']
                        ."\n\n\n".
                        'お問い合わせには、受付時間（9:00～17:00）内に対応させていただきます。'
                        ."\n".
                        '（土・日・祝日・年末年始・夏期休暇を除く）'
                        ."\n\n".
                        '基本、2～3営業日以内に回答させて頂きますが、お問い合わせ内容によっては'
                        ."\n".
                        'お返事を差し上げるまでにお時間をいただく場合がございます。'
                        ."\n\n\n".
                        '---------------------------------------------'
                        ."\n".
                        '株式会社SampleCompany'
                        ."\n".
                        'WEBサイト：http://localhost/'
                        ."\n".
                        '住所：東京都◯◯区〇〇'
                        ."\n".
                        '電話番号：03-0000-0000'
                        ."\n".
                        'メールアドレス：SampleCompany@gmail.com'
                        ."\n".
                        '---------------------------------------------'
                        ;

                $body_admin = 'お問い合わせがありました。'
                        ."\n\n".
                        '氏名：'.$contact['customer_name']
                        ."\n".
                        'メールアドレス：'.$contact['mail']
                        ."\n".
                        'お問合せ内容：'.$contact['body']
                        ."\n".
                        '問合せ日時：'.$contact['modified']
                        ."\n\n".
                        '詳細は管理画面から確認してください。'
                        ."\n".
                        'http://localhost/admin';

                // SampleCompanyに送られるメール

                $email->setFrom(['stst5821@gmail.com' => 'SampleCompany'])
                ->setTo('stst5821@gmail.com')
                ->setSubject('お問い合わせがありました。')
                ->send($body_admin);

                // 顧客（問合せした人）に送られるメール

                $email->setFrom(['stst5821@gmail.com' => 'SampleCompany'])
                ->setTo($contact['mail'])
                ->setSubject('お問い合わせを受付ました。')
                ->send($body_customer);
                
                return $this->redirect(['action' => 'finish']);

            }
            $this->Flash->error(__('登録できませんでした。'));
        }
        $this->set('contact', $contact);
    }


    public function finish()
    {
    }

    public function link()
    {
    }

}


?>