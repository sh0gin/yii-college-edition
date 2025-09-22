<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Application[] $applications
 */
class Courses extends \yii\db\ActiveRecord
{
    public $images;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['images', 'file', 'extensions' => ['png', 'jpg', 'gif'], "maxFiles" => 3]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'images' => 'Изображения'
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['course_id' => 'id']);
    }

    public static function getCourses(): array
    {
        return static::find()
            ->select('name')
            ->indexBy('id')
            ->column(); 
    }
}
