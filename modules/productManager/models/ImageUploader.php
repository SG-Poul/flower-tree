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

    public function getProductImages($productId) //TODO Update for images deleted
    {
        $images = [];
        $imageCount = 1;

        while (file_exists('assets/products/id-' . $productId . '-' . $imageCount . '.png')) {
            $images[] = 'id-' . $productId . '-' . $imageCount . '.png';
            $imageCount++;
        }

        if ($imageCount == 1) {
            $images[] = 'no-image.png';
        }
        return $images;
    }

    public function deleteImage($imageName) // TODO Check if secure
    {
        unlink('assets/products/' . $imageName);
        $count = explode("-", $imageName);
        $productId = $count[1];
        $imageCount = explode(".", $count[2]);
        $imageCount = $imageCount[0];
        $imageCount++;
        while (file_exists('assets/products/id-' . $productId . '-' . $imageCount . '.png')) {
            $newName = strval($imageCount - 1);
            rename('assets/products/id-' . $productId . '-' . $imageCount . '.png', 'assets/products/id-' . $productId . '-' . $newName . '.png');
            $imageCount++;
        }
    }

    public function deleteAllImages($id) // TODO Check if secure
    {
        $imageCount = 1;
        while (file_exists('assets/products/id-' . $id . '-' . $imageCount . '.png')) {
            unlink('assets/products/id-' . $id . '-' . $imageCount . '.png');
            $imageCount++;
        }
    }

    public function setMain($imageName) // TODO Check if secure
    {
        $count = explode("-", $imageName);
        $productId = $count[1];
        $imageCount = explode(".", $count[2]);
        $imageCount = $imageCount[0];

        rename('assets/products/id-' . $productId . '-1.png', 'assets/products/id-' . $productId . '-tmp.png');
        rename('assets/products/id-' . $productId . '-' . $imageCount . '.png', 'assets/products/id-' . $productId . '-1.png');
        rename('assets/products/id-' . $productId . '-tmp.png', 'assets/products/id-' . $productId . '-' . $imageCount . '.png');
    }
}