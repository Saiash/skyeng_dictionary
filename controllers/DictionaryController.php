<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\Dictionary;
use app\models\Errors;
use app\models\Statistic;

class DictionaryController extends Controller {

	private $test_length = 10;
    public $layout = 'dictionary';

	public function beforeAction($action) {            
	    if (in_array($action->id,['get_words','check_word','ending'])) {
	        $this->enableCsrfValidation = false;
	    }
	    return parent::beforeAction($action);
	}

    public function actionIndex() {
        $this->layout = 'dictionary';
        $model = new Statistic;
        return $this->render('index',['model'=>$model]);
    }

    public function actionGet_words() {
		$post = json_decode(file_get_contents('php://input'),true);
		if (count($post['used_words']) < $this->test_length) {
			$list = Dictionary::GetWordsList($post['used_words'],4);
			echo json_encode($list);
		} else {
			echo 'exit';
		}
    }

    public function actionCheck_word() {
		$post = json_decode(file_get_contents('php://input'),true);
		$word = $post['word'];
		$answer = $post['answer'];
		$result = Dictionary::CheckAnswer($word,$answer,$type_key);
		if (!$result) {
			Errors::AddError($word,$answer);
			echo 1;
		} else {
			echo 2;
		}
    }

    public function actionEnding() {
		$post = json_decode(file_get_contents('php://input'),true);
		Statistic::AddTestResult($post['username'],$post['points']);
    }

}
