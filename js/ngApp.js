/**
 * File Name ngApp.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
// ######################################################################


/**
 * ngApp
 **/
var ngApp = angular.module('ngApp', []);

ngApp.controller( 'ngAppCtrl', [
	'$scope'
	,'$sce'
	,function(
		$scope
		,$sce
	) {


	// $scope
	// ########################################
	$scope.text = 'yeah';
	$scope.l = siteObject; // l = local
	$scope.hash = '';



	// General use
	// ########################################
	$scope.permalink = function(url) {
		window.location = url;
	};
	$scope.setHash = function() {
		if ( window.location.hash ) {
			$scope.hash = window.location.hash.replace("#", "");
		}
	};
	$scope.trustHtml = function(html) {
		return $sce.trustAsHtml(html);
	};
	$scope.print = function() {
		window.print();
	}



	// Errors
	// ########################################
	$scope.e = {
		current : []
		,set : function(id) {
			$scope.e.current.push(id);
		}
	};



	// Share
	// ########################################
	$scope.share = {
		fb : function() {
			shareUrl.shareOnFacebook();
		}
		,twitter : function(text) {
			shareUrl.shareOnTwitter(text);
		}
		,googlePlus : function() {
			shareUrl.shareOnGooglePlus()
		}
	};



	// Modal
	// ########################################
	$scope.modal = {
		isShow : 0
		,cssClass : 'modal-default'
		,title : 0
		,html : 0
		,tpl : null
		,isRawHtml : 0
		,formKey : 0
		,scrollTo : 0
		,displayHtml : function() {
			if ( $scope.modal.html != 0 && $scope.modal.tpl == null ) {
				return true;
			} else {
				return false;
			}
		}
		,tpl : null
		,show : function() {
			$scope.modal.isShow = 1;
			if ( $scope.modal.html ) {
				$scope.modal.html = $sce.trustAsHtml($scope.modal.html);
			}
			$scope.modal.close();
			jQuery('body').css({
				'overflow' : 'hidden'
			});
		}
		,hide : function() {
			if ( $scope.modal.scrollTo != 0 ) {
				scrollingJs.scrollTo($scope.modal.scrollTo, 0, 1);
			}

			$scope.modal.html = 0;
			$scope.modal.title = 0;
			$scope.modal.cssClass = 'modal-default';
			$scope.modal.isShow = 0;
			$scope.modal.isRawHtml = 0;
			$scope.modal.formKey = 0;
			$scope.modal.tpl = null;
			$scope.modal.scrollTo = 0;
			jQuery('body').css({
				'overflow' : 'visible'
			});
		}
		,close : function() {
			jQuery(document).mousedown(function(e) {
				var clicked = jQuery(e.target).attr('id');
			    if ( clicked == 'modal' ) {
					$scope.modal.hide();
					$scope.$apply();
			    } else {
					return;
			    }
			});
			jQuery(document).keydown(function(e) {
				switch (e.which) {
					case 27 :
						$scope.modal.hide();
						$scope.$apply();
						break;
				}
			});
		}
		,newsletter : function() { // helper method
			$scope.modal.cssClass = 'modal-newsletter';
			$scope.modal.tpl = '/section-newsletter-large.html';
			$scope.modal.show();
		}
		,iframe : function(html, title) { // helper method
			$scope.modal.cssClass = 'modal-iframe';
			$scope.modal.html = typeof html !== 'undefined' ? html : 0;
			$scope.modal.title = typeof title !== 'undefined' ? title : 0;
			$scope.modal.show();
		}
	};



	// Loader -- Functions
	// ########################################
	$scope.loader = {
		isShow : 0
		,cssClass : 'loader-default'
		,html : 0
		,tpl : null
		,isPaused : 0
		,pauseDelay : 1000
		,displayHtml : function() {
			if ( $scope.loader.html != 0 && $scope.loader.tpl == null ) {
				return true;
			} else {
				return false;
			}
		}
		,start : function() {
			$scope.loader.isShow = 1;
			$scope.loader.isPaused = 1;
			if ( $scope.loader.html ) {
				$scope.loader.html = $sce.trustAsHtml($scope.loader.html);
			}
			jQuery('body').css({
				'overflow' : 'hidden'
			});
			// Use isPaused to put a minimum time on the loader modal to make sure it doesn't "flash".
			/*setTimeout( function() {
				$scope.loader.isPaused = 0;
			}, $scope.loader.pauseDelay );*/
		}
		,stop : function() {
			$scope.loader.isShow = 0;
			$scope.loader.cssClass = 'loader-default';
			$scope.loader.html = 0;
			$scope.loader.tpl = null;
			jQuery('body').css({
				'overflow' : 'visible'
			});
		}
		,testHTML : function() {
			$scope.loader.cssClass = 'modal-test';
			$scope.loader.html = 'Loading html here...';
			$scope.loader.start();
		}
		,testTpl : function() {
			$scope.loader.cssClass = 'modal-test';
			$scope.loader.tpl = '/loader-default.html';
			$scope.loader.start();
		}
	};



	// Initiate
	// ########################################
	$scope.init = function() {
		// $scope.setHash();
	};



	// Init -- Functions
	// ########################################
	jQuery(document).ready(function() {
		// $scope.init();

		/*
		jQuery(window).keydown(function (event){
			// control+l
			if ( event.which == 76 && event.ctrlKey ) {
				// console.log($scope.loader);
				if ( $scope.loader.isShow == 0 ) {
					$scope.loader.testTpl();
				} else {
					$scope.loader.stop();
				}
			}
			$scope.$apply();
		});
		*/
	});



}]);
