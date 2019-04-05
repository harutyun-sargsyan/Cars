<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property int $id
 * @property string $make
 * @property string $model
 * @property string $VIN
 * @property int $year
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Photos[] $photos
 */
class Cars extends \yii\db\ActiveRecord
{

    public $csv;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['csv'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv'],
            [['make', 'model', 'VIN', 'year'], 'required'],
            [['year', 'created_at', 'updated_at'], 'integer'],
            [['make', 'model'], 'string', 'max' => 255],
            [['VIN'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'make' => 'Make',
            'model' => 'Model',
            'VIN' => 'Vin',
            'year' => 'Year',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['car_id' => 'id']);
    }
}
