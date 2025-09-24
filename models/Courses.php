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
 * @property ImageCourse[] $imageCourses
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
            'id' => 'Номер',
            'name' => 'Имя',
            'images' => "Изображение"
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

    /**
     * Gets query for [[ImageCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImageCourses()
    {
        return $this->hasMany(ImageCourse::class, ['id_course' => 'id']);
    }

    public static function getCourses(): array
    {
        return static::find()
            ->select('name')
            ->indexBy('id')
            ->column(); 
    }

}
