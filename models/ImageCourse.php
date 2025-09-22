<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_course".
 *
 * @property int $id
 * @property int $id_course
 * @property string $image
 * @property string $extension
 *
 * @property Courses $course
 */
class ImageCourse extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_course', 'image', 'extension'], 'required'],
            [['id_course'], 'integer'],
            [['image', 'extension'], 'string', 'max' => 255],
            [['id_course'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['id_course' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_course' => 'Id Course',
            'image' => 'Image',
            'extension' => 'Extension',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['id' => 'id_course']);
    }

}
