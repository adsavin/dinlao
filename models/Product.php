<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $village
 * @property string $description
 * @property string $price
 * @property string $created_date
 * @property integer $district_id
 * @property integer $user_id
 * @property string $status
 * @property string $lat
 * @property string $lon
 * @property string $tel
 * @property string $email
 * @property string $whatsapp
 * @property string $line
 * @property string $facebook
 * @property string $wechat
 * @property integer $currency_id
 * @property string $photo
 * @property integer $product_type_id
 * @property integer $doc_type_id
 * @property string $area
 * @property string $width
 * @property string $height
 * @property string $urlmap
 * @property integer $unit_id
 * @property string $facebook_url
 *
 * @property Currency $currency
 * @property District $district
 * @property DocType $docType
 * @property ProductType $productType
 * @property Unit $unit
 * @property User $user
 * @property Picture[] $pictures
 */
class Product extends \yii\db\ActiveRecord
{
    public $photofile;
    public $photofiles;
    public $province_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['village', 'price', 'created_date', 'district_id', 'user_id', 'currency_id', 'product_type_id', 'doc_type_id', 'unit_id'], 'required'],
            [['description', 'urlmap'], 'string'],
            [['price', 'area', 'width', 'height'], 'number'],
            [['created_date', 'province_id'], 'safe'],
            [['photofile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['photofiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            [['district_id','province_id', 'user_id', 'currency_id', 'product_type_id', 'doc_type_id', 'unit_id'], 'integer'],
            [['village', 'lat', 'lon', 'tel', 'email', 'whatsapp', 'line', 'facebook', 'wechat', 'photo'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['doc_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocType::className(), 'targetAttribute' => ['doc_type_id' => 'id']],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'village' => Yii::t('app', 'Village'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'created_date' => Yii::t('app', 'Created Date'),
            'district_id' => Yii::t('app', 'District'),
            'province_id' => Yii::t('app', 'Province'),
            'user_id' => Yii::t('app', 'User'),
            'status' => Yii::t('app', 'Status'),
            'lat' => Yii::t('app', 'Lat'),
            'lon' => Yii::t('app', 'Lon'),
            'tel' => Yii::t('app', 'Tel'),
            'email' => Yii::t('app', 'Email'),
            'whatsapp' => Yii::t('app', 'Whatsapp'),
            'line' => Yii::t('app', 'Line'),
            'facebook' => Yii::t('app', 'Facebook'),
            'wechat' => Yii::t('app', 'Wechat'),
            'currency_id' => Yii::t('app', 'Currency'),
            'photo' => Yii::t('app', 'Photo'),
            'product_type_id' => Yii::t('app', 'Product Type'),
            'doc_type_id' => Yii::t('app', 'Doc Type'),
            'area' => Yii::t('app', 'Area'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'urlmap' => Yii::t('app', 'Urlmap'),
            'unit_id' => Yii::t('app', 'Unit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocType()
    {
        return $this->hasOne(DocType::className(), ['id' => 'doc_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
