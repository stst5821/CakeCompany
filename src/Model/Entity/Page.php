<?php
namespace App\Model\Entity;
 
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
 
class Pages extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    protected $_hidden = [
        'post_id'
    ];
}