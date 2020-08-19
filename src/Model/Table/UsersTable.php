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
        return $validator
            ->notEmpty('username', 'ユーザー名は必須です。')
            ->notEmpty('password', 'パスワードは必須です。')
            ->notEmpty('role', 'A role is required');
    }
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
 
        return $rules;
    }
}