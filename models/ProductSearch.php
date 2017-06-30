<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    public $pricemax;
    public $pricemin;
    public $areamax;
    public $areamin;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_id', 'province_id', 'user_id', 'currency_id', 'product_type_id', 'doc_type_id', 'unit_id'], 'integer'],
            [['village', 'description', 'created_date', 'status', 'lat', 'lon', 'tel', 'email', 'whatsapp', 'line', 'facebook', 'wechat', 'photo', 'urlmap'], 'safe'],
            [['price', 'area', 'width', 'height'], 'number'],
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['province_id'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['district.province_id' => SORT_ASC],
            'desc' => ['district.province_id' => SORT_DESC],
        ];

        $this->load($params);
        if(isset($params["province_id"]))
        $this->province_id = $params["province_id"];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'created_date' => $this->created_date,
            'district_id' => $this->district_id,
            'user_id' => $this->user_id,
            'currency_id' => $this->currency_id,
            'product_type_id' => $this->product_type_id,
            'doc_type_id' => $this->doc_type_id,
            'area' => $this->area,
            'width' => $this->width,
            'height' => $this->height,
            'unit_id' => $this->unit_id,
        ]);

        if($this->province_id !="")
        $query->join("JOIN", "district", "district.id=product.id and district.province_id=:p", [
            ":p" => $this->province_id
        ]);

        $query->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lon', $this->lon])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'line', $this->line])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'wechat', $this->wechat])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'urlmap', $this->urlmap])
        ;

        return $dataProvider;
    }
}
