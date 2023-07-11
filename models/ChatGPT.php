<?php

namespace panix\ext\chatgpt\models;

use panix\engine\CMS;
use panix\engine\Html;
use Yii;
use panix\engine\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ChatGPT extends ActiveRecord
{

    public $disallow_delete = [1];
    const MODULE_ID = 'user';
    const route = '/admin/user/default';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return "{{%chatgpt}}";
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [];
        $rules[] = ['subscribe', 'boolean'];
        // $rules = [
        $rules[] = [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg']];
        // general email and username rules
        $rules[] = [['email', 'username', 'phone', 'first_name', 'last_name', 'middle_name'], 'string', 'max' => 50];
        $rules[] = [['email', 'username'], 'unique'];
        $rules[] = [['email', 'username'], 'filter', 'filter' => 'trim'];
        $rules[] = [['email'], 'email'];
        $rules[] = ['image', 'file'];
        $rules[] = ['birthday', 'date', 'format' => 'php:Y-m-d'];
        $rules[] = ['new_password', 'string', 'min' => 4, 'on' => ['reset', 'change']];
        $rules[] = [['image', 'city', 'instagram_url', 'facebook_url'], 'default'];
        $rules[] = [['instagram_url', 'facebook_url'], 'url'];
        // [['username'], 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => Yii::t('user/default', '{attribute} can contain only letters, numbers, and "_"')],
        // password rules
        //[['newPassword'], 'string', 'min' => 3],
        //[['newPassword'], 'filter', 'filter' => 'trim'],
        $rules[] = [['new_password'], 'required', 'on' => ['reset', 'change']];
        $rules[] = [['password_confirm'], 'required', 'on' => ['register', 'create_user']];
        $rules[] = [['city'], 'string'];
        $rules[] = [['password_confirm', 'password'], 'string', 'min' => 4];
        $rules[] = [['gender', 'points'], 'integer'];
        $rules[] = [['password'], 'required', 'on' => ['register', 'create_user']];
        $rules[] = ['phone', 'panix\ext\telinput\PhoneInputValidator'];
        //[['password_confirm'], 'compare', 'compareAttribute' => 'new_password', 'message' => Yii::t('user/default', 'Passwords do not match')],
        $rules[] = [['password_confirm'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('user/default', 'PASSWORD_NOT_MATCH'), 'on' => 'register'];
        // account page
        $rules[] = [['currentPassword'], 'required', 'on' => ['account']];
        $rules[] = [['currentPassword'], 'validateCurrentPassword', 'on' => ['account']];

        // admin rules
        $rules[] = [['ban_time'], 'date', 'format' => 'php:Y-m-d H:i:s', 'on' => ['admin', 'create_user']];
        $rules[] = [['ban_reason'], 'string', 'max' => 255, 'on' => ['admin', 'create_user']];
        $rules[] = [['role', 'username', 'status'], 'required', 'on' => ['admin', 'create_user']];
        //  ];

        // add required rules for email/username depending on module properties
        $requireFields = ["requireEmail", "requireUsername"];
        foreach ($requireFields as $requireField) {
            if (Yii::$app->getModule("user")->$requireField) {
                $attribute = strtolower(substr($requireField, 7)); // "email" or "username"
                $rules[] = [$attribute, "required"];
            }
        }

        return $rules;
    }

}
