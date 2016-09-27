<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dictionary".
 *
 * @property integer $id
 * @property string $english_name
 * @property string $russian_name
 */
class Dictionary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dictionary';
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
            [['english_name', 'russian_name'], 'required'],
            [['english_name', 'russian_name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'english_name' => 'English Name',
            'russian_name' => 'Russian Name',
        ];
    }

    public function GetWordsList($used_words,$limit) {
        $list = Dictionary::find()->select('id,english_name as 0,russian_name as 1')->where(['not in','id',$used_words])->orderBy(['RAND()' => SORT_DESC])->limit($limit)->asArray()->all();
        $type = rand(0,1);
        $word_id = rand(0,3);
        $word = [$list[$word_id][$type],$list[$word_id]['id']];
        $translates = [];
        foreach ($list as $key => $value) {
            $translates[] = [$value[!$type],0];
        }
        return ['word'=>$word,'translates'=>$translates];
    }

    public function CheckAnswer($word,$answer,$type_key) {
        $types = ['english_name','russian_name'];
        $type_key = (preg_match_all('#[a-zA-Z0-9]#',$word) == strlen($word) ? 0 : 1);
        $result = Dictionary::find()->where([$types[$type_key]=>$word])->andWhere([$types[!$type_key]=>$answer])->asArray()->one();
        $result = (empty($result) ? 0 : 1);
        return $result;
    }
}
