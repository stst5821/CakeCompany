<?php
namespace App\Model\Table;
 
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

// 画像の処理をする関数を使うために必要
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;
 
class UsersTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('username', 'ユーザー名は必須です。');
        $validator->notEmpty('password', 'パスワードは必須です。');
        $validator->notEmpty('role', '権限の入力は必須です。');
        $validator->add('role', [
            'roleCheck' => [
                'rule' => [$this, 'roleCheck'],
                'message' => '管理者が0人になってしまうため変更できません。',
            ],
        ]);
        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
 
        return $rules;
    }
    
    // 権限に問題が無いかをチェック
    public function roleCheck($value, $context)
    {
        // 入力された権限が管理者の場合は問題なくtrue
        if ($context['data']['role'] == USERS__ROLE__SUDO) {
            return true;
        }
        
        // 自分以外の管理者の人数をチェックする
        $count = $this->find()->where([
            'id != ' => $context['data']['id'],
            'role' => USERS__ROLE__SUDO,
        ])->count();

        // countが0ならば、それは自分自身以外に管理者がいないこと
        // →ここでエラーチェックを通してしまうと、保存ができ管理者が0人になってしまう。
        // →なのでカウントが０のばあいはエラー(return false)をかえす。
        if ($count == 0) {
            return false;
        }
        return true;
    }

     // ファイルアップロード関数

    // 98行目あたりの$user['icon'] = $this->file_upload($this->request->data['icon'], $dir, $limitFileSize);から引数を受け取り、実行する。
    public function file_upload ($file = null,$dir = null, $limitFileSize = null){

        try {
            // ファイルを保存するフォルダ $dirの値のチェック
            if (!$dir){
                throw new RuntimeException('ディレクトリの指定がありません。');
            }
            // file_exists関数で変数に値が入っているか確認。
            // $dirが空だったら、実行
            if(!file_exists($dir)){
                throw new RuntimeException('指定のディレクトリがありません。');
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

            // sha1_file関数でファイル名を生成している。
            // sha1(シャーワン)は現在、非推奨だがファイルの同一性チェック目的であれば今も使われている。
            $uploadFile = sha1_file($file["tmp_name"]) . "." . $ext; 

            // 入力されたファイル名をそのまま使用する場合はこちらを使う。
            // ただし、ファイル名が重複する可能性。全角文字（日本語）が文字化けする可能性
            // $uploadFile = $file["name"] . "." . $ext; 

            // ファイルの移動
            if (!@move_uploaded_file($file["tmp_name"], $dir . "/" . $uploadFile)){
                throw new RuntimeException('Failed to move uploaded file.');
            }

            // 処理を抜けたら正常終了
            // echo 'File is uploaded successfully.';

        } catch (RuntimeException $e) {
            throw $e;
        }
        return $uploadFile;
    }
}