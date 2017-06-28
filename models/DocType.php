<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc_type".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $namelao
 *
 * @property Product[] $products
 */
class DocType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doc_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'namelao'], 'required'],
            [['code'], 'string', 'max' => 1],
            [['name', 'namelao'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'namelao' => Yii::t('app', 'Lao Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['doc_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DocTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocTypeQuery(get_called_class());
    }
}
