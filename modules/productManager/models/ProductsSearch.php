<?php

namespace app\modules\productManager\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\productManager\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `app\modules\productManager\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public $categoryName;

    public function rules()
    {
        return [
            [['id', 'categoryId', 'price'], 'integer'],
            [['name'], 'safe'],
            [['categoryName'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['products.id' => SORT_ASC],
                    'desc' => ['products.id' => SORT_DESC],
                    'label' => 'Products ID',
                    'default' => SORT_ASC
                ],
                'name' => [
                    'asc' => ['products.name' => SORT_ASC],
                    'desc' => ['products.name' => SORT_DESC],
                    'label' => 'Products Name',
                ],
                'categoryName' => [
                    'asc' => ['category.name' => SORT_ASC],
                    'desc' => ['category.name' => SORT_DESC],
                    'label' => 'Country Name',
                ],
                'price' => [
                    'asc' => ['products.price' => SORT_ASC],
                    'desc' => ['products.price' => SORT_DESC],
                    'label' => 'Products Price in UAH',
                ],
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'categoryId' => $this->categoryId,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        $query->joinWith(['category']);

        return $dataProvider;
    }
}
