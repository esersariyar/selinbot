<?php
include_once'config/settings.php';
?>
<!-- 

Bu yazılım Eser Sarıyar tarafından geliştirilmiştir. Yazılımın çeşitli alanlarının düzenlenmesi serbesttir.

- Copyright metinlerinin silinmesi yasaktır. (Örneğin: Eser Sarıyar metni gibi)
- Yazılımın satılması kesinlikle yasaktır.
- Yazılım GitHub üzerinde paylaşılacaksa, Eser Sarıyar'ın paylaşmış olduğu repositorie üzerinden fork aracılığı ile paylaşılabilir.


Yazılımın geliştirilme tarihi: 04.06.2022

-->
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title><?php echo $site_title; ?></title>
	<link rel="shortcut icon" type="image/png" href="<?php echo $site_favicon; ?>" />
    <link href="//code.ionicframework.com/1.0.0-beta.14/css/ionic.min.css" rel="stylesheet">
    <script src="//code.ionicframework.com/1.0.0-beta.14/js/ionic.bundle.min.js"></script> 
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-moment/0.8.2/angular-moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  
<style>

body {
  cursor: url('https://cdn.iconscout.com/icon/free/png-256/finger-196-1168201.png'), auto;
}

.bar-footer {
  overflow: visible !important;
}

.bar-footer textarea {
  resize: none;
  height: 25px;
}

button.ion-android-send {
  padding-top: 2px;
}

.footer-btn-wrap {
  position: relative; 
  height: 100%; 
  width: 50px; 
  top: 7px;
}

.footer-btn {
  position: absolute !important; 
  bottom: 0;
}

img.profile-pic {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  position: absolute;
  bottom: 10px;
}

img.profile-pic.left {
  left: 10px;
}

img.profile-pic.right {
  right: 10px;
}

.ion-email {
  float: right;
  font-size: 32px;
  vertical-align: middle;
}

.message {
  font-size: 14px;
}

.message-detail {
  white-space: nowrap;
  font-size: 14px;
}

.bar.item-input-inset .item-input-wrapper input {
  width: 100% !important;
}

.message-wrapper {
  position: relative;
}

.message-wrapper:last-child {
  margin-bottom: 10px;
}

.chat-bubble {
  border-radius: 5px;
  display: inline-block;
  padding: 10px 18px;
  position: relative;
  margin: 10px;
  max-width: 80%;
}

.chat-bubble:before {
  content: "\00a0";
  display: block;
  height: 16px;
  width: 9px;
  position: absolute;
  bottom: -7.5px;
}

.chat-bubble.left {
  background-color: #e6e5eb;
  float: left;
  margin-left: 55px;
}

.chat-bubble.left:before {
  background-color: #e6e5eb;
  left: 10px;
  -webkit-transform: rotate(70deg) skew(5deg);
}

.chat-bubble.right {
  background-color: #158ffe;
  color: #fff;
  float: right;
  margin-right: 55px;
}

.chat-bubble.right:before {
  background-color: #158ffe;
  right: 10px;
  -webkit-transform: rotate(118deg) skew(-5deg);
}

.chat-bubble.right a.autolinker {
  color: #fff;
  font-weight: bold;
}

.user-messages-top-icon {
  font-size: 28px;
  display: inline-block;
  vertical-align: middle;
  position: relative;
  top: -3px;
  right: 5px;
}

.msg-header-username {
  display: inline-block;
  vertical-align: middle;
  position: relative;
  top: -3px;
}

input, textarea, .item-input, .item-input-wrapper {
  background-color: #f4f4f4 !important;
}

.bold {
  font-weight: bold;
}

.cf {
  clear: both !important;
}

a.autolinker {
  color: #3b88c3;
  text-decoration: none;
}

.loader-center {
  height: 100%;
  display: -webkit-box;
  display: -moz-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-direction: normal;
  -moz-box-direction: normal;
  -webkit-box-orient: horizontal;
  -moz-box-orient: horizontal;
  -webkit-flex-direction: row;
  -ms-flex-direction: row;
  flex-direction: row;
  -webkit-flex-wrap: nowrap;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  -webkit-box-pack: center;
  -moz-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-align-content: stretch;
  -ms-flex-line-pack: stretch;
  align-content: stretch;
  -webkit-box-align: center;
  -moz-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.loader .ion-loading-c {
  font-size: 64px;
}

</style>
  <body ng-app="elastichat">
    <ion-nav-bar class="bar-positive" no-tap-scroll="false">
      <ion-nav-back-button class="button-icon ion-arrow-left-c">
      </ion-nav-back-button>
    </ion-nav-bar>
    <ion-nav-view></ion-nav-view>
    <script id="templates/KullanıcıMesajları.html" type="text/ng-template">
      <ion-view id="KullanıcıMesajlarıView"
          cache-view="false" 
          view-title="<i class='icon ion-chatbubble user-messages-top-icon'></i> <div class='msg-header-username'><?php echo $bot_name; ?></div>">
        
        <div class="loader-center" ng-if="!doneLoading">
            <div class="loader">
              <i class="icon ion-loading-c"></i>
            </div>
        </div>
      
          <ion-content has-bouncing="true" class="has-header has-footer" 
              delegate-handle="KullanıcıMesajlarıcroll">
            
              <div ng-repeat="message in messages" class="message-wrapper"
                  on-hold="onMessageHold($event, $index, message)">
      
                  <div ng-if="user._id !== message.userId">
                      
                    <img ng-click="viewProfile(message)" class="profile-pic left" 
                          ng-src="<?php echo $bot_pp; ?>" onerror="onProfilePicError(this)" />
      
                      <div class="chat-bubble left">
      
                          <div class="message" ng-bind-html="message.text | nl2br" autolinker>
                          </div>
      
                          <div class="message-detail">
                              <span ng-click="viewProfile(message)" 
                                  class="bold"><?php echo $bot_name; ?></span>,
                              <span am-time-ago="message.date"></span>
                          </div>
      
                      </div>
                  </div>
      
                  <div ng-if="user._id === message.userId">
                    
                       <img ng-click="viewProfile(message)" class="profile-pic right" 
                          ng-src="{{user.pic}}" onerror="onProfilePicError(this)" />
                    
                      <div class="chat-bubble right">
      
                          <div class="message" ng-bind-html="message.text | nl2br" autolinker>
                          </div>
      
                          <div class="message-detail">
                              <span ng-click="viewProfile(message)" 
                                  class="bold"><?php echo $visitor_name; ?></span>, 
                              <span am-time-ago="message.date"></span>
                          </div>
      
                      </div>
                    
                  </div>
      
                  <div class="cf"></div>
      
              </div>
          </ion-content>
      
          <form name="sendMessageForm" ng-submit="sendMessage(sendMessageForm)" novalidate>
              <ion-footer-bar class="bar-stable item-input-inset message-footer" keyboard-attach>
                  <label class="item-input-wrapper">
                      <textarea id="textarea" ng-model="input.message" value="" placeholder="<?php echo $bot_name; ?>'e bir mesaj gönder..." required minlength="1" maxlength="1500" msd-elastic></textarea>
                  </label>
                  <div class="footer-btn-wrap">
                    <button id="butonsub" class="button button-icon icon ion-android-send footer-btn" type="submit"
                        ng-disabled="!input.message || input.message === ''">
                    </button>
                  </div>
              </ion-footer-bar>
          </form>      
      </ion-view>
    </script>
  </body>
</html>
<span id="gizlioutput" type="hidden" style="display none !important;">Bu mesajı görüntülüyorsanız bir sorun var demektir. Lütfen bize ulaşın.</span>
<script>
angular.module('elastichat', ['ionic', 'monospaced.elastic', 'angularMoment'])

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

  .state('KullanıcıMesajları', {
    url: '/KullanıcıMesajları',
    templateUrl: 'templates/KullanıcıMesajları.html',
    controller: 'KullanıcıMesajlarıCtrl'
  });

  $urlRouterProvider.otherwise('/KullanıcıMesajları');
})

.controller('KullanıcıMesajlarıCtrl', ['$scope', '$rootScope', '$state',
  '$stateParams', 'MockService', '$ionicActionSheet',
  '$ionicPopup', '$ionicScrollDelegate', '$timeout', '$interval',
  function($scope, $rootScope, $state, $stateParams, MockService,
    $ionicActionSheet,
    $ionicPopup, $ionicScrollDelegate, $timeout, $interval) {

    $scope.toUser = {
      _id: '534b8e5aaa5e7afc1b23e69b',
      pic: 'https://source.unsplash.com/random/200x200',
      username: 'Venkman'
    }

    $scope.user = {
      _id: '534b8fb2aa5e7afc1b23e69c',
      pic: 'https://source.unsplash.com/random/200x200',
      username: 'Marty'
    };

    $scope.input = {
      message: localStorage['userMessage-' + $scope.toUser._id] || ''
    };

    var messageCheckTimer;

    var viewScroll = $ionicScrollDelegate.$getByHandle('KullanıcıMesajlarıcroll');
    var footerBar;
    var scroller;
    var txtInput; // ^^^

    $scope.$on('$ionicView.enter', function() {
      // console.log('KullanıcıMesajları $ionicView.enter');
		console.clear();
      getMessages();
      
      $timeout(function() {
        footerBar = document.body.querySelector('#KullanıcıMesajlarıView .bar-footer');
        scroller = document.body.querySelector('#KullanıcıMesajlarıView .scroll-content');
        txtInput = angular.element(footerBar.querySelector('textarea'));
      }, 0);

      messageCheckTimer = $interval(function() {

      }, 20000);
    });

    $scope.$on('$ionicView.leave', function() {
      // console.log('leaving KullanıcıMesajları view, destroying interval');
      if (angular.isDefined(messageCheckTimer)) {
        $interval.cancel(messageCheckTimer);
        messageCheckTimer = undefined;
      }
    });

    $scope.$on('$ionicView.beforeLeave', function() {
      if (!$scope.input.message || $scope.input.message === '') {
        localStorage.removeItem('userMessage-' + $scope.toUser._id);
      }
    });

    function getMessages() {
      MockService.getKullanıcıMesajları({
        toUserId: $scope.toUser._id
      }).then(function(data) {
        $scope.doneLoading = true;
        $scope.messages = data.messages;

        $timeout(function() {
          viewScroll.scrollBottom();
        }, 0);
      });
    }

    $scope.$watch('input.message', function(newValue, oldValue) {
      // console.log('input.message $watch, newValue ' + newValue);
      if (!newValue) newValue = '';
      localStorage['userMessage-' + $scope.toUser._id] = newValue;
    });

    $scope.sendMessage = function(sendMessageForm) {
      var message = {
        toId: $scope.toUser._id,
        text: $scope.input.message
      };
		
      $.ajax({
         url: 'botfonksiyon.php?mesaj='+$scope.input.message,
         success: function(output) {
            $('#gizlioutput').html(output);
         }
      });
	  
      keepKeyboardOpen();

      $scope.input.message = '';

      message._id = new Date().getTime();
      message.date = new Date();
      message.username = $scope.user.username;
      message.userId = $scope.user._id;
      message.pic = $scope.user.picture;

      $scope.messages.push(message);

      $timeout(function() {
        keepKeyboardOpen();
        viewScroll.scrollBottom(true);
      }, 0);

      $timeout(function() {
        $scope.messages.push(MockService.getMockMessage());
        keepKeyboardOpen();
        viewScroll.scrollBottom(true);
      }, 2000);

      //});
    };
    
    function keepKeyboardOpen() {
      // console.log('keepKeyboardOpen');
      txtInput.one('blur', function() {
        // console.log('textarea blur, focus back on it');
        txtInput[0].focus();
      });
    }

    $scope.onMessageHold = function(e, itemIndex, message) {
      // console.log('onMessageHold');
      // console.log('message: ' + JSON.stringify(message, null, 2));
      $ionicActionSheet.show({
        buttons: [{
          text: 'Metni Kopyala'
        }, {
          text: 'Mesajı Sil'
        }],
        buttonClicked: function(index) {
          switch (index) {
            case 0:
              //cordova.plugins.clipboard.copy(message.text);
			    var value = message.text;
				var tempInput = document.createElement("input");
				tempInput.style = "position: absolute; left: -1000px; top: -1000px";
				tempInput.value = value;
				document.body.appendChild(tempInput);
				tempInput.select();
				document.execCommand("copy");
				document.body.removeChild(tempInput);
              break;
            case 1:
              $scope.messages.splice(itemIndex, 1);
              $timeout(function() {
                viewScroll.resize();
              }, 0);

              break;
          }
          
          return true;
        }
      });
    };

    $scope.viewProfile = function(msg) {
      if (msg.userId === $scope.user._id) {
		  
      } else {
		  
      }
    };
    
    $scope.$on('taResize', function(e, ta) {
      // console.log('taResize');
      if (!ta) return;
      
      var taHeight = ta[0].offsetHeight;
      // console.log('taHeight: ' + taHeight);
      
      if (!footerBar) return;
      
      var newFooterHeight = taHeight + 10;
      newFooterHeight = (newFooterHeight > 44) ? newFooterHeight : 44;
      
      footerBar.style.height = newFooterHeight + 'px';
      scroller.style.bottom = newFooterHeight + 'px'; 
    });

}])

.factory('MockService', ['$http', '$q',
  function($http, $q) {
    var me = {};

    me.getKullanıcıMesajları = function(d) {
      var deferred = $q.defer();
      
		 setTimeout(function() {
      	deferred.resolve(getMockMessages());
	    }, 1500);
      
      return deferred.promise;
    };

    me.getMockMessage = function() {
	  let gizlioutput = document.getElementById("gizlioutput").innerHTML;
      return {
        userId: '534b8e5aaa5e7afc1b23e69b',
        date: new Date(),
        text: gizlioutput
		};  
    }

    return me;
  }
])

.filter('nl2br', ['$filter',
  function($filter) {
    return function(data) {
      if (!data) return data;
      return data.replace(/\n\r?/g, '<br />');
    };
  }
])


.directive('autolinker', ['$timeout',
  function($timeout) {
    return {
      restrict: 'A',
      link: function(scope, element, attrs) {
        $timeout(function() {
          var eleHtml = element.html();

          if (eleHtml === '') {
            return false;
          }

          var text = Autolinker.link(eleHtml, {
            className: 'autolinker',
            newWindow: false
          });

          element.html(text);

          var autolinks = element[0].getElementsByClassName('autolinker');

          for (var i = 0; i < autolinks.length; i++) {
            angular.element(autolinks[i]).bind('click', function(e) {
              var href = e.target.href;
              // console.log('autolinkClick, href: ' + href);

              if (href) {
                //window.open(href, '_system');
                window.open(href, '_blank');
              }

              e.preventDefault();
              return false;
            });
          }
        }, 0);
      }
    }
  }
])

function onProfilePicError(ele) {
  this.ele.src = '';
}

function getMockMessages() {
  return {"messages":[{"_id":"535d625f898df4e80e2a125e","text":"Merhaba","userId":"534b8fb2aa5e7afc1b23e69c","date":"<?php echo date('Y-m-d H:i:s'); ?>","read":true,"readDate":"<?php echo date('Y-m-d H:i:s'); ?>"},{"_id":"535f13ffee3b2a68112b9fc0","text":"Merhaba, ben <?php echo $bot_name; ?>.","userId":"534b8e5aaa5e7afc1b23e69b","date":"<?php echo date('Y-m-d H:i:s'); ?>","read":true,"readDate":"<?php echo date('Y-m-d H:i:s'); ?>"},{"_id":"54764399ab43d1d4113abfd1","text":"Ben <a href='https://esersariyar.com' style='text-decoration: none !important;' target='_blank'>Eser Sarıyar</a> tarafından MeetWeb için geliştirilmiş olan ve siz değerli kullanıcılarımız tarafından gelişmeye devam eden, kullanıcıların yönettiği yapay zekalı bir robotum.","userId":"534b8e5aaa5e7afc1b23e69b","date":"<?php echo date('Y-m-d H:i:s'); ?>","read":true,"readDate":"<?php echo date('Y-m-d H:i:s'); ?>"},{"_id":"547643aeab43d1d4113abfd2","text":"Bu harika! o halde başlayalım mı seni geliştirmeye?","userId":"534b8fb2aa5e7afc1b23e69c","date":"<?php echo date('Y-m-d H:i:s'); ?>","read":true,"readDate":"<?php echo date('Y-m-d H:i:s'); ?>"},{"_id":"547815dbab43d1d4113abfef","text":"Başlayalım! Benimle sohbet ederek beni geliştirebilirsin. Bilmediğim kelime veya cümleleri sana sorarak öğreneceğim. Bana kötü sözler, öğretmezsen sevinirim. Eğer sana kötü bir söz söylersem, bunu bana siz kullanıcıların öğrettiğini bilin. ","userId":"534b8e5aaa5e7afc1b23e69b","date":"<?php echo date('Y-m-d H:i:s'); ?>","read":true,"readDate":"<?php echo date('Y-m-d H:i:s'); ?>"}],"unread":0};
}

moment.locale('tr', {
  relativeTime: {
    future: "gelecek %s",
    past: "%s önce",
    s: "%d saniye",
    m: "bir dakika",
    mm: "%d dakika",
    h: "saat",
    hh: "%d saat",
    d: "gün",
    dd: "%d gün",
    M: "ay",
    MM: "%d ay",
    y: "year",
    yy: "%d yıl"
  }
});

angular.module('monospaced.elastic', [])

  .constant('msdElasticConfig', {
    append: ''
  })

  .directive('msdElastic', [
    '$timeout', '$window', 'msdElasticConfig',
    function($timeout, $window, config) {
      'use strict';

      return {
        require: 'ngModel',
        restrict: 'A, C',
        link: function(scope, element, attrs, ngModel) {

          var ta = element[0],
              $ta = element;

          if (ta.nodeName !== 'TEXTAREA' || !$window.getComputedStyle) {
            return;
          }

          $ta.css({
            'overflow': 'hidden',
            'overflow-y': 'hidden',
            'word-wrap': 'break-word'
          });

          var text = ta.value;
          ta.value = '';
          ta.value = text;

          var append = attrs.msdElastic ? attrs.msdElastic.replace(/\\n/g, '\n') : config.append,
              $win = angular.element($window),
              mirrorInitStyle = 'position: absolute; top: -999px; right: auto; bottom: auto;' +
                                'left: 0; overflow: hidden; -webkit-box-sizing: content-box;' +
                                '-moz-box-sizing: content-box; box-sizing: content-box;' +
                                'min-height: 0 !important; height: 0 !important; padding: 0;' +
                                'word-wrap: break-word; border: 0;',
              $mirror = angular.element('<textarea tabindex="-1" ' +
                                        'style="' + mirrorInitStyle + '"/>').data('elastic', true),
              mirror = $mirror[0],
              taStyle = getComputedStyle(ta),
              resize = taStyle.getPropertyValue('resize'),
              borderBox = taStyle.getPropertyValue('box-sizing') === 'border-box' ||
                          taStyle.getPropertyValue('-moz-box-sizing') === 'border-box' ||
                          taStyle.getPropertyValue('-webkit-box-sizing') === 'border-box',
              boxOuter = !borderBox ? {width: 0, height: 0} : {
                            width:  parseInt(taStyle.getPropertyValue('border-right-width'), 10) +
                                    parseInt(taStyle.getPropertyValue('padding-right'), 10) +
                                    parseInt(taStyle.getPropertyValue('padding-left'), 10) +
                                    parseInt(taStyle.getPropertyValue('border-left-width'), 10),
                            height: parseInt(taStyle.getPropertyValue('border-top-width'), 10) +
                                    parseInt(taStyle.getPropertyValue('padding-top'), 10) +
                                    parseInt(taStyle.getPropertyValue('padding-bottom'), 10) +
                                    parseInt(taStyle.getPropertyValue('border-bottom-width'), 10)
                          },
              minHeightValue = parseInt(taStyle.getPropertyValue('min-height'), 10),
              heightValue = parseInt(taStyle.getPropertyValue('height'), 10),
              minHeight = Math.max(minHeightValue, heightValue) - boxOuter.height,
              maxHeight = parseInt(taStyle.getPropertyValue('max-height'), 10),
              mirrored,
              active,
              copyStyle = ['font-family',
                           'font-size',
                           'font-weight',
                           'font-style',
                           'letter-spacing',
                           'line-height',
                           'text-transform',
                           'word-spacing',
                           'text-indent'];
						   
          if ($ta.data('elastic')) {
            return;
          }

          maxHeight = maxHeight && maxHeight > 0 ? maxHeight : 9e4;

          if (mirror.parentNode !== document.body) {
            angular.element(document.body).append(mirror);
          }

          $ta.css({
            'resize': (resize === 'none' || resize === 'vertical') ? 'none' : 'horizontal'
          }).data('elastic', true);

          function initMirror() {
            var mirrorStyle = mirrorInitStyle;

            mirrored = ta;
            taStyle = getComputedStyle(ta);
            angular.forEach(copyStyle, function(val) {
              mirrorStyle += val + ':' + taStyle.getPropertyValue(val) + ';';
            });
            mirror.setAttribute('style', mirrorStyle);
          }

          function adjust() {
            var taHeight,
                taComputedStyleWidth,
                mirrorHeight,
                width,
                overflow;

            if (mirrored !== ta) {
              initMirror();
            }

            if (!active) {
              active = true;

              mirror.value = ta.value + append;
              mirror.style.overflowY = ta.style.overflowY;

              taHeight = ta.style.height === '' ? 'auto' : parseInt(ta.style.height, 10);

              taComputedStyleWidth = getComputedStyle(ta).getPropertyValue('width');

              if (taComputedStyleWidth.substr(taComputedStyleWidth.length - 2, 2) === 'px') {
                width = parseInt(taComputedStyleWidth, 10) - boxOuter.width;
                mirror.style.width = width + 'px';
              }

              mirrorHeight = mirror.scrollHeight;

              if (mirrorHeight > maxHeight) {
                mirrorHeight = maxHeight;
                overflow = 'scroll';
              } else if (mirrorHeight < minHeight) {
                mirrorHeight = minHeight;
              }
              mirrorHeight += boxOuter.height;
              ta.style.overflowY = overflow || 'hidden';

              if (taHeight !== mirrorHeight) {
                ta.style.height = mirrorHeight + 'px';
                scope.$emit('elastic:resize', $ta);
              }
              
              scope.$emit('taResize', $ta);

              $timeout(function() {
                active = false;
              }, 1);

            }
          }

          function forceAdjust() {
            active = false;
            adjust();
          }

          if ('onpropertychange' in ta && 'oninput' in ta) {
            ta['oninput'] = ta.onkeyup = adjust;
          } else {
            ta['oninput'] = adjust;
          }

//ENTER KONTROL ETME
$('#textarea').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
    $("#butonsub").click()
  }
});
				
          $win.bind('resize', forceAdjust);

          scope.$watch(function() {
            return ngModel.$modelValue;
          }, function(newValue) {
            forceAdjust();
          });

          scope.$on('elastic:adjust', function() {
            initMirror();
            forceAdjust();
          });

          $timeout(adjust);

          scope.$on('$destroy', function() {
            $mirror.remove();
            $win.unbind('resize', forceAdjust);
          });
        }
      };
    }
  ]);

//MESAJ KONTROLLERİ İÇİN
!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.returnExportsGlobal=b()}):"object"==typeof exports?module.exports=b():a.Autolinker=b()}(this,function(){var a=function(b){a.Util.assign(this,b),this.matchValidator=new a.MatchValidator};return a.prototype={constructor:a,urls:!0,email:!0,twitter:!0,newWindow:!0,stripPrefix:!0,className:"",htmlCharacterEntitiesRegex:/(&nbsp;|&#160;|&lt;|&#60;|&gt;|&#62;)/gi,matcherRegex:function(){var a=/(^|[^\w])@(\w{1,15})/,b=/(?:[\-;:&=\+\$,\w\.]+@)/,c=/(?:[A-Za-z][-.+A-Za-z0-9]+:(?![A-Za-z][-.+A-Za-z0-9]+:\/\/)(?!\d+\/?)(?:\/\/)?)/,d=/(?:www\.)/,e=/[A-Za-z0-9\.\-]*[A-Za-z0-9\-]/,f=/\.(?:international|construction|contractors|enterprises|photography|productions|foundation|immobilien|industries|management|properties|technology|christmas|community|directory|education|equipment|institute|marketing|solutions|vacations|bargains|boutique|builders|catering|cleaning|clothing|computer|democrat|diamonds|graphics|holdings|lighting|partners|plumbing|supplies|training|ventures|academy|careers|company|cruises|domains|exposed|flights|florist|gallery|guitars|holiday|kitchen|neustar|okinawa|recipes|rentals|reviews|shiksha|singles|support|systems|agency|berlin|camera|center|coffee|condos|dating|estate|events|expert|futbol|kaufen|luxury|maison|monash|museum|nagoya|photos|repair|report|social|supply|tattoo|tienda|travel|viajes|villas|vision|voting|voyage|actor|build|cards|cheap|codes|dance|email|glass|house|mango|ninja|parts|photo|shoes|solar|today|tokyo|tools|watch|works|aero|arpa|asia|best|bike|blue|buzz|camp|club|cool|coop|farm|fish|gift|guru|info|jobs|kiwi|kred|land|limo|link|menu|mobi|moda|name|pics|pink|post|qpon|rich|ruhr|sexy|tips|vote|voto|wang|wien|wiki|zone|bar|bid|biz|cab|cat|ceo|com|edu|gov|int|kim|mil|net|onl|org|pro|pub|red|tel|uno|wed|xxx|xyz|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cw|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sx|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|za|zm|zw)\b/,g=/[\-A-Za-z0-9+&@#\/%=~_()|'$*\[\]?!:,.;]*[\-A-Za-z0-9+&@#\/%=~_()|'$*\[\]]/;return new RegExp(["(",a.source,")","|","(",b.source,e.source,f.source,")","|","(","(?:","(",c.source,e.source,")","|","(?:","(.?//)?",d.source,e.source,")","|","(?:","(.?//)?",e.source,f.source,")",")","(?:"+g.source+")?",")"].join(""),"gi")}(),charBeforeProtocolRelMatchRegex:/^(.)?\/\//,link:function(b){var c=this,d=this.getHtmlParser(),e=this.htmlCharacterEntitiesRegex,f=0,g=[];return d.parse(b,{processHtmlNode:function(a,b,c){"a"===b&&(c?f=Math.max(f-1,0):f++),g.push(a)},processTextNode:function(b){if(0===f)for(var d=a.Util.splitAndCapture(b,e),h=0,i=d.length;i>h;h++){var j=d[h],k=c.processTextNode(j);g.push(k)}else g.push(b)}}),g.join("")},getHtmlParser:function(){var b=this.htmlParser;return b||(b=this.htmlParser=new a.HtmlParser),b},getTagBuilder:function(){var b=this.tagBuilder;return b||(b=this.tagBuilder=new a.AnchorTagBuilder({newWindow:this.newWindow,truncate:this.truncate,className:this.className})),b},processTextNode:function(a){var b=this;return a.replace(this.matcherRegex,function(a,c,d,e,f,g,h,i,j){var k=b.processCandidateMatch(a,c,d,e,f,g,h,i,j);if(k){var l=b.createMatchReturnVal(k.match,k.matchStr);return k.prefixStr+l+k.suffixStr}return a})},processCandidateMatch:function(b,c,d,e,f,g,h,i,j){var k,l=i||j,m="",n="";if(c&&!this.twitter||f&&!this.email||g&&!this.urls||!this.matchValidator.isValidMatch(g,h,l))return null;if(this.matchHasUnbalancedClosingParen(b)&&(b=b.substr(0,b.length-1),n=")"),f)k=new a.match.Email({matchedText:b,email:f});else if(c)d&&(m=d,b=b.slice(1)),k=new a.match.Twitter({matchedText:b,twitterHandle:e});else{if(l){var o=l.match(this.charBeforeProtocolRelMatchRegex)[1]||"";o&&(m=o,b=b.slice(1))}k=new a.match.Url({matchedText:b,url:b,protocolUrlMatch:!!h,protocolRelativeMatch:!!l,stripPrefix:this.stripPrefix})}return{prefixStr:m,suffixStr:n,matchStr:b,match:k}},matchHasUnbalancedClosingParen:function(a){var b=a.charAt(a.length-1);if(")"===b){var c=a.match(/\(/g),d=a.match(/\)/g),e=c&&c.length||0,f=d&&d.length||0;if(f>e)return!0}return!1},createMatchReturnVal:function(b,c){var d;if(this.replaceFn&&(d=this.replaceFn.call(this,this,b)),"string"==typeof d)return d;if(d===!1)return c;if(d instanceof a.HtmlTag)return d.toString();var e=this.getTagBuilder(),f=e.build(b);return f.toString()}},a.link=function(b,c){var d=new a(c);return d.link(b)},a.match={},a.Util={abstractMethod:function(){throw"abstract"},assign:function(a,b){for(var c in b)b.hasOwnProperty(c)&&(a[c]=b[c]);return a},extend:function(b,c){var d=b.prototype,e=function(){};e.prototype=d;var f;f=c.hasOwnProperty("constructor")?c.constructor:function(){d.constructor.apply(this,arguments)};var g=f.prototype=new e;return g.constructor=f,g.superclass=d,delete c.constructor,a.Util.assign(g,c),f},ellipsis:function(a,b,c){return a.length>b&&(c=null==c?"..":c,a=a.substring(0,b-c.length)+c),a},indexOf:function(a,b){if(Array.prototype.indexOf)return a.indexOf(b);for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},splitAndCapture:function(a,b){if(!b.global)throw new Error("`splitRegex` must have the 'g' flag set");for(var c,d=[],e=0;c=b.exec(a);)d.push(a.substring(e,c.index)),d.push(c[0]),e=c.index+c[0].length;return d.push(a.substring(e)),d}},a.HtmlParser=a.Util.extend(Object,{htmlRegex:function(){var a=/[0-9a-zA-Z][0-9a-zA-Z:]*/,b=/[^\s\0"'>\/=\x01-\x1F\x7F]+/,c=/(?:".*?"|'.*?'|[^'"=<>`\s]+)/,d=b.source+"(?:\\s*=\\s*"+c.source+")?";return new RegExp(["(?:","<(!DOCTYPE)","(?:","\\s+","(?:",d,"|",c.source+")",")*",">",")","|","(?:","<(/)?","("+a.source+")","(?:","\\s+",d,")*","\\s*/?",">",")"].join(""),"gi")}(),parse:function(a,b){b=b||{};for(var c,d=b.processHtmlNode||function(){},e=b.processTextNode||function(){},f=this.htmlRegex,g=0;null!==(c=f.exec(a));){var h=c[0],i=c[1]||c[3],j=!!c[2],k=a.substring(g,c.index);k&&e(k),d(h,i.toLowerCase(),j),g=c.index+h.length}if(g<a.length){var l=a.substring(g);l&&e(l)}}}),a.HtmlTag=a.Util.extend(Object,{whitespaceRegex:/\s+/,constructor:function(b){a.Util.assign(this,b),this.innerHtml=this.innerHtml||this.innerHTML},setTagName:function(a){return this.tagName=a,this},getTagName:function(){return this.tagName||""},setAttr:function(a,b){var c=this.getAttrs();return c[a]=b,this},getAttr:function(a){return this.getAttrs()[a]},setAttrs:function(b){var c=this.getAttrs();return a.Util.assign(c,b),this},getAttrs:function(){return this.attrs||(this.attrs={})},setClass:function(a){return this.setAttr("class",a)},addClass:function(b){for(var c,d=this.getClass(),e=this.whitespaceRegex,f=a.Util.indexOf,g=d?d.split(e):[],h=b.split(e);c=h.shift();)-1===f(g,c)&&g.push(c);return this.getAttrs()["class"]=g.join(" "),this},removeClass:function(b){for(var c,d=this.getClass(),e=this.whitespaceRegex,f=a.Util.indexOf,g=d?d.split(e):[],h=b.split(e);g.length&&(c=h.shift());){var i=f(g,c);-1!==i&&g.splice(i,1)}return this.getAttrs()["class"]=g.join(" "),this},getClass:function(){return this.getAttrs()["class"]||""},hasClass:function(a){return-1!==(" "+this.getClass()+" ").indexOf(" "+a+" ")},setInnerHtml:function(a){return this.innerHtml=a,this},getInnerHtml:function(){return this.innerHtml||""},toString:function(){var a=this.getTagName(),b=this.buildAttrsStr();return b=b?" "+b:"",["<",a,b,">",this.getInnerHtml(),"</",a,">"].join("")},buildAttrsStr:function(){if(!this.attrs)return"";var a=this.getAttrs(),b=[];for(var c in a)a.hasOwnProperty(c)&&b.push(c+'="'+a[c]+'"');return b.join(" ")}}),a.MatchValidator=a.Util.extend(Object,{invalidProtocolRelMatchRegex:/^[\w]\/\//,hasFullProtocolRegex:/^[A-Za-z][-.+A-Za-z0-9]+:\/\//,uriSchemeRegex:/^[A-Za-z][-.+A-Za-z0-9]+:/,hasWordCharAfterProtocolRegex:/:[^\s]*?[A-Za-z]/,isValidMatch:function(a,b,c){return b&&!this.isValidUriScheme(b)||this.urlMatchDoesNotHaveProtocolOrDot(a,b)||this.urlMatchDoesNotHaveAtLeastOneWordChar(a,b)||this.isInvalidProtocolRelativeMatch(c)?!1:!0},isValidUriScheme:function(a){var b=a.match(this.uriSchemeRegex)[0];return"javascript:"!==b&&"vbscript:"!==b},urlMatchDoesNotHaveProtocolOrDot:function(a,b){return!(!a||b&&this.hasFullProtocolRegex.test(b)||-1!==a.indexOf("."))},urlMatchDoesNotHaveAtLeastOneWordChar:function(a,b){return a&&b?!this.hasWordCharAfterProtocolRegex.test(a):!1},isInvalidProtocolRelativeMatch:function(a){return!!a&&this.invalidProtocolRelMatchRegex.test(a)}}),a.AnchorTagBuilder=a.Util.extend(Object,{constructor:function(b){a.Util.assign(this,b)},build:function(b){var c=new a.HtmlTag({tagName:"a",attrs:this.createAttrs(b.getType(),b.getAnchorHref()),innerHtml:this.processAnchorText(b.getAnchorText())});return c},createAttrs:function(a,b){var c={href:b},d=this.createCssClass(a);return d&&(c["class"]=d),this.newWindow&&(c.target="_blank"),c},createCssClass:function(a){var b=this.className;return b?b+" "+b+"-"+a:""},processAnchorText:function(a){return a=this.doTruncate(a)},doTruncate:function(b){return a.Util.ellipsis(b,this.truncate||Number.POSITIVE_INFINITY)}}),a.match.Match=a.Util.extend(Object,{constructor:function(b){a.Util.assign(this,b)},getType:a.Util.abstractMethod,getMatchedText:function(){return this.matchedText},getAnchorHref:a.Util.abstractMethod,getAnchorText:a.Util.abstractMethod}),a.match.Email=a.Util.extend(a.match.Match,{getType:function(){return"email"},getEmail:function(){return this.email},getAnchorHref:function(){return"mailto:"+this.email},getAnchorText:function(){return this.email}}),a.match.Twitter=a.Util.extend(a.match.Match,{getType:function(){return"twitter"},getTwitterHandle:function(){return this.twitterHandle},getAnchorHref:function(){return"https://twitter.com/"+this.twitterHandle},getAnchorText:function(){return"@"+this.twitterHandle}}),a.match.Url=a.Util.extend(a.match.Match,{urlPrefixRegex:/^(https?:\/\/)?(www\.)?/i,protocolRelativeRegex:/^\/\//,protocolPrepended:!1,getType:function(){return"url"},getUrl:function(){var a=this.url;return this.protocolRelativeMatch||this.protocolUrlMatch||this.protocolPrepended||(a=this.url="http://"+a,this.protocolPrepended=!0),a},getAnchorHref:function(){var a=this.getUrl();return a.replace(/&amp;/g,"&")},getAnchorText:function(){var a=this.getUrl();return this.protocolRelativeMatch&&(a=this.stripProtocolRelativePrefix(a)),this.stripPrefix&&(a=this.stripUrlPrefix(a)),a=this.removeTrailingSlash(a)},stripUrlPrefix:function(a){return a.replace(this.urlPrefixRegex,"")},stripProtocolRelativePrefix:function(a){return a.replace(this.protocolRelativeRegex,"")},removeTrailingSlash:function(a){return"/"===a.charAt(a.length-1)&&(a=a.slice(0,-1)),a}}),a});

</script>
