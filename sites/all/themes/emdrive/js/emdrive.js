var myApp = angular.module('emdrive', ['node', 'nodes', 'infinite-scroll', 'ngSanitize']);
myApp.controller('scrollController', function($scope, $http) {
    position_background();
    jQuery(window).resize(function() {
        $scope.$apply(position_background);
    });
	$scope.items = [];
	$scope.loadNext = function() {
		$id = $nodes.shift();
		if($id != null) {
            delete $http.defaults.headers.common['X-ANGULARJS'];
			$http({method: "GET", url: '/home/' + $id}).
			then(function(response) {
				$scope.items.push(response.data);
			});
		}
	};
	$scope.loadNext()
	$scope.loadNext()
});

function position_background() {
    jQuery('#page').css('background-position', jQuery('#page').position().left + "px 0px");
}
