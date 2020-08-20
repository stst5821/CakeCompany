<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;
 
use Cake\Controller\Controller;
use Cake\Event\Event;
 
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
 
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // 現在ログインしている人のレコードを取り出して、user変数にsetし、viewで使えるようにしている。
        // ログインしたときの情報をloginアクションのところで、$this->Auth->setUser($user);を使って事前に保管している。
        
        
        $this->loadModel("Users");
 
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        
        $this->loadComponent('Flash');
 
        // 認証のコンポーネント
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authenticate' => [
                // Formは、Basic認証（基本認証）とDigest認証が選べる。
                'Form' => [
                    'userModel' => 'Users',
                    'fields' => [
                        // キーの部分が属性、値の部分がデータベースのカラム名を指す。
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
        ]); 
        
        //ログインしている場合
        if (!empty($this->Auth->user())) {
            //ログインフラグをtrueにする
            define("IS_LOGIN", true);
            //管理者全権限をもってたら管理者フラグをtrueにする
            // 今ログインしているAuth->userのidで、Usersテーブル内を検索してヒットしたデータを$userに格納して
            $user = $this->Users->find()->where(["id" => $this->Auth->user('id')])->first();
            // $userのroleと、USERS__ROLE__SUDOを比較して、同じかどうかチェックする。
            define("IS_SUDO", $user->role == USERS__ROLE__SUDO);

            $this->set('login_user', $this->Auth->user('username'));
            $this->set('login_user_id', $this->Auth->user('id'));
            
        //ログインしていない場合
        } else {
            //ログインフラグfalse
            define("IS_LOGIN", false);
            //管理者フラグfalse
            define("IS_SUDO", false);
        }
 
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
}