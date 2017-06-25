<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DocType]].
 *
 * @see DocType
 */
class DocTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return DocType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DocType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
