<?php
namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

use CakeORMTableRegistry;

class PagesController extends AppController
{
    public $paginate = [
        'limit' => 6 ,
        'order' => ['created' => 'desc']
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        // $this->loadHelper('Paginator', ['templates' => 'paginator-templates']);
    }
    
    public function index()
    {
        // ページネーションを追加する。
        $this->loadModel('Posts');
        $pages = $this->paginate($this->Posts);

        // USERテーブルを全件検索して、$postsに代入。
        // $this->Pages->find('all')
        //          ↑ここは絶対にコントローラ名にしないといけない。この文は、Model/Table/pagesTableを見に行っている？
        $this->set('pages', $pages);
    }
    public function company()
    {
    }
    public function service()
    {
    }
    public function recruit()
    {
    }
    public function link()
    {
    }

}


?>