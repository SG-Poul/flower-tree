<?php
namespace app\modules\productManager\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageUploader extends Model
{
    public $uploadedFiles;

    public function rules()
    {
        return [
            [['uploadedFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10]];
    }

    public function upload($productId)
    {
        if ($this->validate()) {
            $imageCount = 1;
            foreach ($this->uploadedFiles as $file) {
                while (file_exists('assets/products/id-' . $productId . '-' . $imageCount . '.png')) $imageCount++;

                if ($file->extension == 'png') {
                    $file->saveAs('assets/products/id-' . $productId . '-' . $imageCount . '.png');
                } else if ($file->error == UPLOAD_ERR_OK) {
                    imagepng(imagecreatefromstring(file_get_contents($file->tempName)), 'assets/products/id-' . $productId . '-' . $imageCount . '.png', 9, PNG_ALL_FILTERS);
                }
            }
            return true;
        } else {
            return false;
        }
    }
}