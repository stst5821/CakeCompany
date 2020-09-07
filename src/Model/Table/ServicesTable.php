<?php
namespace App\Model\Table;
 
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
class ServicesTable extends AppTable {
    
    public function initialize(array $config) {
        parent::initialize($config);

        // Usersテーブルを結合する
        $this->belongsTo('Users');
    }

    public function validationDefault(Validator $validator) {
        return $validator->requirePresence('title', 'body')
                        ->notEmpty('title')
                        ->notEmpty('body');
    }
    
    public function buildRules(RulesChecker $rules) {
        return $rules;
    }
}