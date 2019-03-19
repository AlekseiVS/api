<?php

namespace app\models;

use Yii;
use DateTime;
use DateInterval;
/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property string $original_name
 * @property string $new_name
 * @property int $status
 * @property string $date_create
 * @property string $date_end
 */
class Link extends \yii\db\ActiveRecord
{

    const DAYS = 1;
//    public $days;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['original_name'], 'required'],
            [['days'], 'integer', 'min' => 0],
            [['status'], 'integer', 'min' => 0, 'max' => 1],
            [['status', 'days', 'date_create', 'date_end', 'new_name'], 'safe'],
            [['original_name', 'new_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'original_name' => 'Original Name',
            'new_name' => 'New Name',
            'status' => 'Status',
            'date_create' => 'Date Create',
            'date_end' => 'Date End',
        ];
    }





}
