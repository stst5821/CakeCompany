<?php
namespace App\Model\Entity;
 
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
 
class Contact extends Entity
{
    public $flagLabels= [
        CONTENTS__FLAG__NOT_YET => 'NotYet', // 1
        CONTENTS__FLAG__DONE => 'Done' // 2
    ];
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    protected $_hidden = [
        // 'post_id'
    ];

    // これを呼び出すと、未対応と対応済の2つが呼び出される。
    public function _getFlagLabels()
    {
        return $this->flagLabels;
    }

    // 呼び出すと、roleLabelsに値が入っていたら、その値を取り出し、無かったら空白を出す。三項演算子を使っている。
    public function _getFlagLabel()
    {
        return isset($this->flagLabels[$this->flag]) ? $this->flagLabels[$this->flag] : '';
    }

}