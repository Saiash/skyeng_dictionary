<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statistic".
 *
 * @property integer $id
 * @property string $test_date
 * @property string $username
 * @property integer $points
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistic';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dictionary');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_date', 'username', 'points'], 'required'],
            [['test_date'], 'safe'],
            [['points'], 'integer'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_date' => 'Test Date',
            'username' => 'Имя',
            'points' => 'Points',
        ];
    }

    public function AddTestResult($username,$points) {
        $model = new Statistic;
        $model->test_date = date('Y-m-d H:i:s');
        $model->username = $username;
        $model->points = $points;
        $model->save();
    }
}
