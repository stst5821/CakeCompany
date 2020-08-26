<?php
namespace App\Model\Table;
 
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
class AppTable extends Table
{
    // createdやmodifiedに、自動で日時を入れてくれる。
    // MySQLのテーブル上で、createdやmodifiedのデフォルト値に「current_timestamp()」をつけていなくても、
    // これを書くと自動で付与されるようになる。
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
    }
}