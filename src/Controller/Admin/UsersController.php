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
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

class UsersController extends AppController
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

        // default.ctpに現在ログインしているユーザー名を表示するため、ログイン中ユーザーのusernameをセットしている。
        // $this->set('login_user', $this->Auth->user('username'));
    }

    // indexメソッド
    //////////////////////////////////////////////////////////////////////////////////////////////

    
    public function index()
    {
        // 管理者でない場合は、indexにリダイレクトさせる。
        if (!IS_SUDO) {
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }
        
        $users = $this->paginate($this->Users);
        $this->set('users', $users);

        // Usersテーブルのadminの数をカウント。
        $count = $this->Users->find()->where(['role' => USERS__ROLE__SUDO])->count();
        $this->set('count', $count);
        
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
        // 管理者でない場合は、indexにリダイレクトさせる。
        if (!IS_SUDO) {
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {         
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            // WWW_ROOTは、フォルダの位置を示す定数
            $dir = realpath(WWW_ROOT . "/upload_img"); //アップロードするファイルを保存するフォルダのパスを指定
            $limitFileSize = 1024 * 1024; // アップロードするファイルの容量の最大値を指定
            
            try {
                // $this->file_uploadで、ファイルアップロード関数を呼び出している。
                // file_uploadの()の中は引数で、関数に３つの値を渡している。
                // $file = $this->request->data['icon']
                // $dir = realpath(WWW_ROOT . "/upload_img"); 89行目あたりで代入している。
                // $limitFileSize = 1024 * 1024
                $user['icon'] = $this->Users->file_upload($this->request->data['icon'], $dir, $limitFileSize);          
            } 
            catch (RuntimeException $e) {
                $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                $this->Flash->error(__($e->getMessage()));
            }
            
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
        if (!IS_SUDO) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set('user', $this->Auth->user('id'));

        // editするため選択したレコードがadminだったら実行する。
        $user = $this->Users->get($id);
        $this->set('user', $user);

        // Usersテーブルのadminの数をカウント。
        $count = $this->Users->find()->where(['role' => 1])->count();
        $this->set('count', $count);
        
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        // ユーザーがedit.ctpで項目を入力してsubmitすると、
        // そのデータがまたこのコントローラに送られてきて、このif文でチェックされる。

        if ($this->request->is(['patch', 'post', 'put'])) {         
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            // WWW_ROOTは、フォルダの位置を示す定数
            $dir = realpath(WWW_ROOT . "/upload_img"); //アップロードするファイルを保存するフォルダのパスを指定
            $limitFileSize = 1024 * 1024; // アップロードするファイルの容量の最大値を指定

        // deleteボタンがクリックされたとき

        if(isset($this->request->data["file_delete"])){
            try {
                $del_file = new File($dir . "/". $this->request->data["file_before"]);
                // ファイル削除処理実行
                if($del_file->delete()) {
                    $news['icon'] = "";
                } else {
                    $news['icon'] = $this->request->data["file_before"];
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->Flash->error(__($e->getMessage()));
            }
        } 
        else 
        {
            // ファイルが入力されたとき
            if($this->request->data["icon"]["name"]){
                $limitFileSize = 1024 * 1024;
                try {
                    $user['icon'] = $this->Users->file_upload($this->request->data['icon'], $dir, $limitFileSize);
                    // ファイル更新の場合は古いファイルは削除
                    if (isset($this->request->data["file_before"])){
                        // ファイル名が同じ場合は削除を実行しない
                        if ($this->request->data["file_before"] != $user['icon']){
                            $del_file = new File($dir . "/". $this->request->data["file_before"]);
                            if(!$del_file->delete()) {
                                $this->log("ファイル更新時に下記ファイルが削除できませんでした。",LOG_DEBUG);
                                $this->log($this->request->data["file_before"],LOG_DEBUG);
                            }
                        }
                    }
                
                } catch (RuntimeException $e){
                    // アップロード失敗の時、既登録ファイルがある場合はそれを保持
                    if (isset($this->request->data["file_before"])){
                        $user['icon'] = $this->request->data["file_before"];
                    }
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                // ファイルは入力されていないけど登録されているファイルがあるとき
                if (isset($this->request->data["file_before"])){
                    $user['icon'] = $this->request->data["file_before"];
                }
            }
        }

        if ($this->Users->save($user)) {
            $this->Flash->success(__('The news has been saved.'));

            if(isset($this->request->data["file_delete"])){
                $this->set(compact('user'));
                return $this->redirect(['action' => 'edit', $id]);
            } else {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->Flash->error(__('The news could not be saved. Please, try again.'));
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
}

    // Delete メソッド
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function delete($id = null)
    {
        if (!IS_SUDO) {
            return $this->redirect(['action' => 'index']);
        }

        // 許可するデータ受け取り方法を決める。
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        $dir = realpath(WWW_ROOT . "/upload_img");
        
        try {

            $del_file = new File($dir . "/". $user->icon);
            // ファイル削除処理実行
            if(!$del_file->delete()) {
                throw new RuntimeException('ファイルの削除ができませんでした.');
            }
            $user['icon'] = "";

        } catch (RuntimeException $e){
            $this->log($e->getMessage(),LOG_DEBUG);
            $this->log($user->icon,LOG_DEBUG);
        }

        if (!$this->Users->delete($user)) {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        } 
        
        $this->Flash->success(__('削除できました。.'));
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