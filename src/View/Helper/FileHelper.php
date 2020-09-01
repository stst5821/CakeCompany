<?php
namespace App\View\Helper;
use Cake\View\Helper;
use Cake\Datasource\ModelAwareTrait;

class FileHelper extends Helper
{
    use ModelAwareTrait;
    protected $_defaultConfig = [];

    //StaticFilesデータからパスを取得
    public function getFilePath($data)
    {
        $fileName = md5($data["id"] . $data["created"]) . "." . $data["extension"];
        return WWW_URL . "files/" . $fileName;
    }

    //imageIDからパスを取得
    public function getFilePathFromId($imageId)
    {
        //$this->loadModel('Images');
        $data = $this->Images->find('all')->where(['id' => $imageId])->first();
        if (empty($data)) {
            return false;
        }
        return $this->getFilePath($data);
    }
    public function getIconPass($icon)
    {
        return '/webroot/upload_img/' . $icon;
    }
}