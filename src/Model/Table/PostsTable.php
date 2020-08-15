<?php
namespace App\Model\Table;
 
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
class PostsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
 
        $this->setTable('posts');
        $this->setDisplayField('post_id');
        $this->setPrimaryKey('post_id');
 
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('body', 'A username is required');
    }
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['post_id']));
 
        return $rules;
    }
}