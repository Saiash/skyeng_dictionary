var dictionary = angular.module('dictionary',[]);

dictionary.controller('dictionaryController', function dictionaryListController($scope, $http) {
		
	$scope.showDetails = false;
	$scope.username = null;
	$scope.showEnding = false;
	$scope.used_words = [];
	$scope.points = 0;
	$scope.mistakes = 0;

	$scope.get_words = function() {
		$http({method: 'POST',url:"/dictionary/get_words", data: {used_words: $scope.used_words}}).then(function(response) {
		    $scope.check_test(response);
		    if (typeof(response.data['word']) != 'undefined' ) {
			    $scope.select_words = response.data['translates'];
			    $scope.answer_word = response.data['word'];
			    $scope.used_words.push($scope.answer_word[1]);
			}
		});
	};
	$scope.check = function(key) {
		$http({method: 'POST',url:"/dictionary/check_word", data: {word: $scope.answer_word[0], answer: $scope.select_words[key][0] }}).then(function(response) {
			$scope.select_words[key][1] = response.data;
			if (response.data == 1) {
				$scope.mistakes++;
			} else {
				$scope.points++;
				$scope.get_words();
			}
			$scope.check_test(response);
		});
	};
	$scope.check_test = function(response) {
		if ($scope.mistakes >= 3 || response.data == 'exit') {
			$scope.showDetails = false;
			$scope.call_ending();
		} else {
			$scope.showDetails = true;
		}
	}
	$scope.call_ending = function() {
		$scope.showEnding = true;
		$http({method: 'POST',url:"/dictionary/ending", data: {username: $scope.username, points: $scope.points }});
	}
	$scope.begin_test = function () {
		if ($scope.username_input != null) { 
			$scope.showDetails = true; 
			$scope.username = $scope.username_input; 
			$scope.get_words()
		}
	}
});