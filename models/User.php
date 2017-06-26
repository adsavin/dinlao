<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $birthdate
 * @property string $status
 * @property string $registerd_date
 * @property string $role
 * @property string $picture
 *
 * @property Product[] $products
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        $model = User::find()->where("email=:email", [
            ":email" => $id
        ])->one();

        return isset($model) ? new static($model) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'firstname', 'lastname', 'birthdate', 'status', 'registerd_date', 'role'], 'required'],
            [['birthdate', 'registerd_date'], 'safe'],
            [['email', 'password', 'firstname', 'lastname', 'picture'], 'string', 'max' => 255],
            [['status', 'role'], 'string', 'max' => 1],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'status' => Yii::t('app', 'Status'),
            'registerd_date' => Yii::t('app', 'Registerd Date'),
            'role' => Yii::t('app', 'Role'),
            'picture' => Yii::t('app', 'Picture'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
