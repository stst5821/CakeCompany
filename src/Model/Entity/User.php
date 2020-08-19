<?php
namespace App\Model\Entity;
 
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
 
class User extends Entity
{
    public $roleLabels= [
        USERS__ROLE__SUDO => '管理者',
        USERS__ROLE__USER => '一般',
    ];
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    protected $_hidden = [
        'password'
    ];
 
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

    // これを呼び出すと、管理者・一般の2つが呼び出される。
    public function _getRoleLabels()
    {
        return $this->roleLabels;
    }

    // 呼び出すと、roleLabelsに値が入っていたら、その値を取り出し、無かったら空白を出す。三項演算子を使っている。
    public function _getRoleLabel()
    {
        return isset($this->roleLabels[$this->role]) ? $this->roleLabels[$this->role] : '';
    }
}