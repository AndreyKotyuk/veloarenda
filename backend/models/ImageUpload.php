<?php

namespace backend\models;


use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;
    public $folder;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg, png, jpeg']
        ];
    }
    
    public function __construct($path)
    {
        $this->folder = $path;
    }

    /**
     * @param UploadedFile $file
     * @param $image
     * @return string
     * @internal param $model
     */
    public function uploadFile(UploadedFile $file, $image)
    {
        $this->image = $file;
        $folder = $this->getFolder();

        if ($this->validate()) {
            if ((!file_exists($folder) && mkdir($folder, 0777, true)) || file_exists($folder)) {
                $this->deleteCurrentImage($image);
            }
            return $this->saveImage($folder);
        }
    }

    public function getFolder()
    {
        return Yii::getAlias('@frontend') . '/web/storage/' . $this->folder;
    }

    /**
     * @return string
     */
    public function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    /**
     * @param $image
     * @internal param $folder
     * @internal param $model
     */
    public function deleteCurrentImage($image)
    {
        if ($this->fileExist($image)) {
            unlink($this->getFolder() . $image);
        }
    }

    /**
     * @param $folder
     * @param $model
     * @return bool
     */
    public function fileExist($image)
    {
        if(!empty($image) && $image!=null){
            return file_exists($this->getFolder() . $image) && $image;
        }
    }

    /**
     * @param $folder
     * @return string
     */
    public function saveImage($folder)
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($folder . $filename);
        return $filename;
    }

}