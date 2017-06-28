<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $namelao
 *
 * @property Product[] $products
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'nam'], 'required'],
            [['code'], 'string', 'max' => 10],
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
        return $this->hasMany(Product::className(), ['unit_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitQuery(get_called_class());
    }
}
