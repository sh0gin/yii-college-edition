<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $data_start
 * @property int $user_id
 * @property int $course_id
 * @property int $pay_type_id
 * @property int $status_id
 * @property string $created_at
 *
 * @property Courses $course
 * @property Feedback $feedback
 * @property PayType $payType
 * @property Status $status
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{

    public $time_order;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_start', 'user_id', 'course_id', 'pay_type_id', 'status_id', 'time_order'], 'required'],
            [['data_start', 'created_at'], 'safe'],
            [['user_id', 'course_id', 'pay_type_id', 'status_id'], 'integer'],
            // [['status_id'], 'unique'],
            // [['user_id'], 'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'id']],
            [['pay_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayType::class, 'targetAttribute' => ['pay_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['data_start', 'date', 'min' => date('d.m.Y'), 'format' => 'dd.MM.yyyy'],
            ['time_order', 'time', 'format' => 'php:H:i', 'min' => '09:00', 'max' => '18:00'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'data_start' => 'Дата начала обучения',
            'user_id' => 'Клиент',
            'course_id' => 'Наименование курса',
            'pay_type_id' => 'Способ оплаты',
            'status_id' => 'Статус заявки',
            'created_at' => 'Дата создания заявки',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Feedback]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedback()
    {
        return $this->hasOne(Feedback::class, ['application_id' => 'id']);
    }

    /**
     * Gets query for [[PayType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayType()
    {
        return $this->hasOne(PayType::class, ['id' => 'pay_type_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
