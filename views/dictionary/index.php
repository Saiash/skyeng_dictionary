<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCss('
	body {
		background-color: #f9f9f9;
		padding-top: 80px;
	}
	.main {
		background: #ffffff;
		border-radius: 5px;
		overflow: auto;
		border: 1px solid #e8e8e8;
		padding: 25px;
		box-shadow: 2px 2px 9px -3px #333333;
	}
	.test_list {
		padding: 0;
	    list-style-type: none;
	    overflow: auto;
	    padding-top: 20px;
	}
	.test_list_i {
		float: left;
		width: 10%;
		display: inline-block;
	}
	.test_list_i .point {
		width: 10px;
		height: 10px;
		background: #aaaaaa;
		margin: auto;
	}
	.test_list_i .point.success {
		background: green;
	}
	.test_list_i .point.error {
		background: red;
	}
	.word {
		font-size: 18px;
		font-weight: bold;
	}
');
$this->registerJs("
	$('.test_data').submit(function(){
 		$('button[name=\"begin_test\"]').click();
 		return false;
 	});
");
$this->registerJsFile('/web/js/dictionary.controller.js');
$this->title = 'Словарь';
?>
<div class="row" ng-app="dictionary" ng-Controller="dictionaryController">
	<div class="main col-sm-6 col-sm-offset-3" >
			<h1 class="text-center" style="margin-top: 0;"><?php echo $this->title ?></h1>
			<?php
				$form = ActiveForm::begin([ 'fieldConfig' => ['template' => "{label}\n<div class='col-sm-10'>{input}\n{hint}</div>"],
											'options'=>['ng-show'=>'!username',
														'ng-submit'=>"window.alert('Should not see me');",
														'method'=>'post', 
														'class'=>'form-horizontal test_data']]);
				echo $form->field($model,'username',['labelOptions'=>['class'=>'col-sm-2 control-label'],
										'options'=>['class'=>'form-group  form-group-lg',
													"style"=>'margin: 5px 0px 20px 0px;']])
					->textInput(["class"=>'col-sm-10 form-control',
								'ng-model'=>'username_input']);
				echo Html::button('Начать тест',["name"=>"begin_test",
												'class'=>'btn btn-primary btn-lg btn-block', 
												'type'=>'button',
												'ng-click'=>"begin_test()"]);
				ActiveForm::end(); 
			 ?>
			 <div class="test_container"  ng-show="showDetails == true;">
			 	<div>Набрано баллов: <strong>{{points}}</strong></div>
			 	<div>Ошибок: <strong>{{mistakes}}</strong></div>
			 	<div style="margin-bottom: 10px;">Выберите правильный перевод для слова: <span class="word">{{answer_word[0]}}</span></div>
				<?=	Html::button('{{value[0]}}',['class'=>'btn btn-default btn-block', 
												'type'=>'button', 
												'ng-repeat'=>'(key, value) in select_words', 
												"ng-class"=>"[{'btn-danger':value[1]==1,'btn-success':value[1]==2}]", 
												"ng-click"=>'check(key)']); ?>
			 </div>
			 <div class="text-center" ng-show="showEnding == true;">
			 	Спасибо за прохождение теста!<br>
			 	Ваши баллы: {{points}}<br>
			 	Количество ошибок: {{mistakes}}
			 </div>
 	</div>
 </div>