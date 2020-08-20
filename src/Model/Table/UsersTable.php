<?php
namespace App\Model\Table;
 
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
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
}