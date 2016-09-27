<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "errors".
 *
 * @property integer $id
 * @property string $word
 * @property string $answer
 */
class Errors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'errors';
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
            [['word', 'answer'], 'required'],
            [['word', 'answer'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'answer' => 'Answer',
        ];
    }

    public function AddError($word,$answer) {
        $error = new Errors;
        $error->word = $word;
        $error->answer = $answer;
        $error->save();
    }
}
