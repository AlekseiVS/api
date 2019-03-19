<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_transition".
 *
 * @property int $id
 * @property int $link_id
 * @property string $date_transition
 * @property string $referer
 * @property string $ip_address
 * @property string $browser
 */
class DataTransition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_transition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_id'], 'integer'],
            [['link_id', 'referer', 'ip_address', 'browser', 'date_transition'], 'safe'],
            [['referer', 'ip_address', 'browser'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_id' => 'Link ID',
            'date_transition' => 'Date Transition',
            'referer' => 'Referer',
            'ip_address' => 'Ip Address',
            'browser' => 'Browser',
        ];
    }




    static function getDataTransition($id){

        if($id) {

            $countTransitionAll = Yii::$app->db->createCommand("
            SELECT count(link_id) as count_transition
            FROM data_transition
            WHERE link_id = $id
            GROUP BY link_id")
                ->queryOne();

            $countTransitionDate = Yii::$app->db->createCommand("
            SELECT date, count(link_id) as count_transition 
            FROM data_transition 
            WHERE link_id = $id
            GROUP BY link_id, date")->queryAll();

            $countTransitionBrowser = Yii::$app->db->createCommand("
            SELECT  COUNT(browser) as count_browser, browser
            FROM data_transition
            WHERE link_id = $id
            GROUP BY  browser, link_id")->queryAll();

            $countTransitionReferer = Yii::$app->db->createCommand("
            SELECT  referer, COUNT(referer) as count_refer
            FROM data_transition
            WHERE link_id = $id
            GROUP BY  referer")->queryAll();


            $arrStatistic = [
                'countTransitionAll' => $countTransitionAll,
                'countTransitionDate' => $countTransitionDate,
                'countTransitionBrowser' => $countTransitionBrowser,
                'countTransitionReferer' => $countTransitionReferer,
            ];

            if($arrStatistic['countTransitionAll'])
                return $arrStatistic;
        }

            return "No data";
    }
}
