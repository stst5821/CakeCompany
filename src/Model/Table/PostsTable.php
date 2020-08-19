<?php
namespace App\Model\Table;
 
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
class PostsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        // Usersテーブルを結合する
        $this->belongsTo('Users');
 
    }
    public function validationDefault(Validator $validator)
    {
        return $validator->notEmpty('body', 'A username is required');
    }
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }

    // 自分で作成したオリジナル関数(最新$limit件の投稿データを取得できる便利な関数)
    public function getRecentPost($limit)
    {
        return $this->find()->order(["created" => "desc"])->limit($limit)->all();
    }
}