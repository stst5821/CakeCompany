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
                // ここはコンポーネントとして作成したほうがいい？
                $user['icon'] = $this->file_upload($this->request->data['icon'], $dir, $limitFileSize);          
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

    // ファイルアップロード関数

    public function file_upload ($file = null,$dir = null, $limitFileSize = 1024 * 1024){
        try {
            // ファイルを保存するフォルダ $dirの値のチェック
            if ($dir){
                if(!file_exists($dir)){
                    throw new RuntimeException('指定のディレクトリがありません。');
                }
            } else {
                throw new RuntimeException('ディレクトリの指定がありません。');
            }
 
            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($file['error']) || is_array($file['error'])){
                throw new RuntimeException('Invalid parameters.');
            }
 
            // エラーのチェック
            switch ($file['error']) {
                case 0:
                    break;
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
 
            // ファイル情報取得
            $fileInfo = new File($file["tmp_name"]);
 
            // ファイルサイズのチェック
            if ($fileInfo->size() > $limitFileSize) {
                throw new RuntimeException('Exceeded filesize limit.');
            }
 
            // ファイルタイプのチェックし、拡張子を取得
            if (false === $ext = array_search($fileInfo->mime(),
                ['jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',],
                true)){
                throw new RuntimeException('Invalid file format.');
            }
 
            // ファイル名の生成
//            $uploadFile = $file["name"] . "." . $ext;
            $uploadFile = sha1_file($file["tmp_name"]) . "." . $ext;
 
            // ファイルの移動
            if (!@move_uploaded_file($file["tmp_name"], $dir . "/" . $uploadFile)){
                throw new RuntimeException('Failed to move uploaded file.');
            }
 
            // 処理を抜けたら正常終了
//            echo 'File is uploaded successfully.';
 
        } catch (RuntimeException $e) {
            throw $e;
        }
        return $uploadFile;
    }


    // editメソッド
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function edit($id = null)
    {
        if (!IS_SUDO) 
        {
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

        if ($this->request->is(['patch', 'post', 'put']))
        {
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
    //////////////////////////////////////////////////////////////////////////////////////////////


    public function delete($id = null)
    {
        if (!IS_SUDO) {
            return $this->redirect(['action' => 'index']);
        }

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