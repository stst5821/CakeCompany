<?php
namespace App\Model\Entity;
 
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
 
class Contact extends Entity
{
    public $flagLabels= [
        CONTACTS__FLAG__NOT_YET => 'NotYet', // 1
        CONTACTS__FLAG__DONE => 'Done' // 2
    ];
    public $flagLabelsForJapanese = [
        CONTACTS__FLAG__NOT_YET => '未対応', // 1
        CONTACTS__FLAG__DONE => '対応済' // 2
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
    public function _getFlagLabelForJapanese()
    {
        return isset($this->flagLabelsForJapanese[$this->flag]) ? $this->flagLabelsForJapanese[$this->flag] : '';
    }

}