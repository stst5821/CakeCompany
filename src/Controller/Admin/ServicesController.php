<?php
namespace App\Controller\Admin;

/**
 * Users Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use CakeORMTableRegistry;

class ServicesController extends AppController
{

    // ページネーション 表示数を決める
    public $paginate = [
        'limit' => 6,
        'order' => ['created' => 'desc']
    ];

    public function initialize()
    {
        parent::initialize();

        // ページネーションのコンポーネントをロード
        $this->loadComponent('Paginator');
    }


    // index
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    public function index()
    {
        // $this->Services->find('all')で、Servicesの全エンティティを取り出し、setメソッドで'persons'という変数に値を設定している。
        $services = $this->paginate($this->Services->find('all'));
        $this->set('services',$services);
    }


    // add
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function add() {

        $service = $this->Services->newEntity();

        if (!$this->request->is(['patch', 'post', 'put'])) {
            $this->set('service', $service);
            return;
        }
        
        // $serviceに、フォームから入力されたデータを入れている。
        $service = $this->Services->patchEntity($service, $this->request->getData());
        // ↑patchEntity(newEntityで指定した変数, getDataでフォームに入力されたデータ)
        if (!$this->Services->save($service)) {
            $this->Flash->error(__('投稿できませんでした。'));
            
        }
        
        // saveが成功したら、flashメッセージを出して、indexにリダイレクトさせる。
        $this->Flash->success(__('ユーザーを登録しました。'));
        return $this->redirect(['action' => 'index']);    

    }

    // edit
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    public function edit($id = null)
    {

        // URLパラメータとして送られた値で、Servicesテーブルからレコードを取り出し、$serviceに代入。
        $service = $this->Services->get($id);

        // アクセス方式をチェック。postかputでチェックして、アクセスがなかったら、$serviceをserviceという名前で設定。returnで次の処理へ
        // フォームヘルパーを使い、Entityの値を更新する場合、putも追加する必要がある。
        if (!$this->request->is(['post', 'put'])) {
            $this->set('service', $service);
            return;
        }

        $service = $this->Services->patchEntity($service, $this->request->getData());

        if (!$this->Services->save($service)) {
            $this->Flash->error(__('修正できませんでした。'));
        }

        // saveが成功したら、flashメッセージを出して、indexにリダイレクトさせる。
        $this->Flash->success(__('サービス内容を修正しました。'));
        return $this->redirect(['action' => 'index']);    
    }

    public function delete($id = null)
    {

        // getとdeleteのリクエストのみ受付。postだとエラーを出す。
        $this->request->allowMethod(['get']);

        if (empty($id)) {
            $this->redirect(['action' => 'index']);
            return;
        }

        $service = $this->Services->get($id);

        if (empty($service)) {
            $this->redirect(['action' => 'index']);
            return;
        }

        if (!$this->Services->delete($service)) {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        $this->Flash->success(__('削除できました。.'));
    
        return $this->redirect(['action' => 'index']);
    }

    //     // URLパラメータとして送られた値で、Servicesテーブルからレコードを取り出し、$serviceに代入。
    //     $this->request->allowMethod(['get', 'delete']);

    //     // アクセス方式をチェック。postかputでチェックして、アクセスがなかったら、$serviceをserviceという名前で設定。returnで次の処理へ
    //     // フォームヘルパーを使い、Entityの値を更新する場合、putも追加する必要がある。

    //     $service = $this->Services->get($id);
    //     if (!$this->request->is(['post', 'put'])) {
            
    //         $this->set('service', $service);
    //         return;
    //     }

    //     if ($this->Services->delete($service)) {
    //         $this->Flash->success(__('サービス内容を修正しました。'));
    //         return $this->redirect(['action' => 'index']);
        
    //     }
    // }

}