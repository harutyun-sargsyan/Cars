<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "csv_upload".
 *
 * @property int $id
 * @property string $csv
 */
class CsvUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'csv_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csv'], 'required'],
            [['csv'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'csv' => 'Csv',
        ];
    }
}
