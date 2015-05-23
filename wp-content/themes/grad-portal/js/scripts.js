var isTouchDevice = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isTouchDevice.Android() || isTouchDevice.BlackBerry() || isTouchDevice.iOS() || isTouchDevice.Opera() || isTouchDevice.Windows());
    }
};



$(function(){

var _handleShown = true,
	_fullpageActive = false,
	_isTablet,
	_isMobile,
	_isDesktop,
	_container,
	_scrollDirection,
	_currentPathName;


//accept cookies control

if ($.cookie('accept_cookies')) { // if cookie exists do nothing
  
  } else { // show the cookie banner
    setTimeout(function() { $('#cookie-alert').slideDown(100); }, 1000);
   
}

// notification message

show_notification = function(_message,_confirm,_callback){
    _confirm = typeof _confirm !== 'undefined' ? _confirm : 0;
    _callback = typeof _callback !== 'undefined' ? _callback : 0;
    $('#notification main').html(_message);
    if(_confirm){
        $('#notification .confirm').show();
    } else {
        $('#notification .confirm').hide();
        setTimeout(function(){
           $('#notification').fadeOut(100); 
        },4000)

    }
        $('#notification').slideDown(100);
}
//gravity form validation hook

$(document).bind('gform_post_render', function(){
    if($('.validation_error').length){
        var _message = $('.validation_error').text();
        show_notification(_message);
    }
});

if($('#search-form').length){
    init_form_field_replace();
}

$(window).on( 'DOMMouseScroll mousewheel', function ( event ) {
  if( event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0 ) { 
    //scroll down
    _scrollDirection = 'down';
  } else {
    //scroll up
   	_scrollDirection = 'up';
  }
});
//
});