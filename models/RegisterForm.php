<?php

namespace app\models;

use app\models\User as User;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{

            // <!-- * @property string $fullName
            // * @property string $login
            // * @property string $password
            // * @property string $email
            // * @property string $phone -->


    public $fullName;
    public $login;
    public $email;
    public $password;
    public $phone;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fullName', 'login', 'password', 'email', 'phone'], 'required'],
            [['fullName', 'login', 'password', 'email', 'phone'], 'string', 'max' => 255],
            [['password'], 'string', "min" => 8],
            [['login'], 'match', 'pattern' => '/^[a-z\d]+$/i', "message" => 'Логин может содержать только буквы и цифры'],
            [['fullName'], 'match', 'pattern' => '/^[а-яе]+\s[а-яе]+\s([a-яё\s]+)$/iu', "message" => 'ФИО может быть написано только кириллицей и не менее двух пробелов'],
            [['email'], 'email'],
            [['login'], 'unique', 'targetClass' => User::class],
            ['phone', 'match', 'pattern' => '/^8\([\d]{3}\)[\d]{3}(\-[\d]{2}){2}$/', "message" => 'Телефон (формат: 8(XXX)XXX-XX-XX)']
            // [['login'], 'unique'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullName' => 'ФИО',
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Адрес электронной почты',
            'phone' => 'Тел',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function register(): User | bool
    {
        if ($this->validate()) {
            $user = new User();
            // $user->login = $this->login;
            
            $user->load($this->attributes, ''); 
            $user->password = Yii::$app->security->generatePasswordHash($user->password);
            $user->authKey = Yii::$app->security->generateRandomString();
            if (!$user->save()) {
                VarDumper::dump($user->errors); die;
            }


            return $user ?? false;
        }
        return false;
    }
}
