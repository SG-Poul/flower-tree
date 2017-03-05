<?php

namespace app\modules\productManager\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property integer $categoryId
 * @property integer $price
 *
 * @property Description[] $descriptions
 * @property Category $category
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'categoryId'], 'required'],
            [['categoryId', 'price'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'categoryId' => 'Category ID',
            'categoryName' => 'Category',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescriptions()
    {
        return $this->hasMany(Description::className(), ['productId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function getCategoryName()
    {
        return $this->category->name;
    }

    public function getMainPhoto()
    {
        if (file_exists('assets/products/id-' . $this->id . '-1.png')) {

            return '<img class="thumbnail img-responsive" src="../assets/products/id-' . $this->id . '-1.png">';
        } else {
            return '<img class="thumbnail img-responsive" src="../assets/products/no-image.png">';
        }
    }
}
