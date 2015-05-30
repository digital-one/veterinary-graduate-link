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

function get_url_parameter(sParam){

var sPageURL = window.location.search.substring(1);
var sURLVariables = sPageURL.split('&');
for (var i = 0; i < sURLVariables.length; i++){
 var sParameterName = sURLVariables[i].split('=');
if (sParameterName[0] == sParam){
    return sParameterName[1];
    }
    }
}


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
//stop role selection form submitting without selecting option
$('body').on('submit','#role-selection form',function(){
    if ($('input[name=role]:checked').length > 0) {
        return true;
    }
    return false;
  
  /*  if($('input[name=role]'). val()==''){
        return false;
    }
    return true;*/
})

$('.menu-toggle').on('click',function(e){
    e.preventDefault();
    _nav = $('#nav')
    if(_nav.hasClass('active')){
        _nav.removeClass('active').fadeOut(300);
        $(this).removeClass('active');
        $('#account-links').show();
    } else {
        _nav.addClass('active').fadeIn(300);
        $('#account-links').hide();
          $(this).addClass('active');
    }

})
//hide the mobile menu on scroll

$(window).on('scroll resize',function(){
    if($('#nav.active').length){
        $('.menu-toggle').removeClass('active');
        $('#account-links').show();
        $('#nav').removeClass('active').fadeOut(300);
    }
})

if($('.g-recaptcha').length){
var _target_li = $('.g-recaptcha').parents('li').eq(0);
_target_li.addClass('small-12 columns');
}


$('body').on('click','.cancel',function(e){
    e.preventDefault();
    hide_notification();
})

$('.notification-btn').on('click',function(e){
    e.preventDefault();
    _elms  =$('#notification, #role-selection, #login-form, #reset-password-request-form, #reset-password-form');
    _elms.hide();
    var _target = $('#'+$(this).attr('rel'));
    if($('#notification-panel .active').length){
        reset_notification();
        _elms.removeClass('active');
        _target.show().addClass('active');
} else {
    reset_notification();
    _elms.removeClass('active');
     _target.slideDown(100).addClass('active');
     $('#account-links').hide();
     $('.menu-toggle').hide();
}
})
// notification message
reset_notification = function(){
    $('#notification-panel .notification').each(function(){
        $('input[type=text]',$(this)).val('');
        $('.validation_error',$(this)).text('');
    })
}
hide_notification = function(){
    $('#notification-panel .active').slideUp(100).removeClass('active');
    $('#account-links').show();
    $('.menu-toggle').show();
}
show_notification = function(_message,_confirm,_callback){
    _confirm = typeof _confirm !== 'undefined' ? _confirm : 0;
    _callback = typeof _callback !== 'undefined' ? _callback : 0;
    $('#notification').html(_message).addClass('active');
    $('#account-links').hide();
    $('.menu-toggle').hide();
    if(_confirm){
       // $('#notification .confirm').show();
    } else {
      //  $('#notification .confirm').hide();
        setTimeout(function(){
          hide_notification();
        },4000)

    }
        $('#notification').slideDown(100);
}

//customisation to show candidate alert fields on checkbox select

function show_ca_fields(){

_checkbox = $('#choice_23_1');
_fields = $('.ca-field');

if($(_checkbox).is(':checked')){
    _fields.show();
    }

$('#choice_23_1').on('click',function(){
    _this = $(this);
    if($(_this).is(':checked')){
        _fields.show();
    } else {
        _fields.hide();
    }
})
$('body').on('click','#choice_23_1_replace',function(e){
        _this = $(this);
      if(_this.hasClass('checked')){
          _fields.show();
      } else {
          _fields.hide();
      }
});
}
//show_ca_fields();
//check if form saved/updated parameter is in url. If so, display relevant confirmation message.
function saved_form_confirmation(){
    _message='';
    if(get_url_parameter('updated')){
    _message = 'Your profile has been successfully updated.';
      //  show_notification(_message);
   }
   if(get_url_parameter('saved')){
    _message = 'Thank you for registering. We have sent you an email to confirm your account.';
      //  show_notification(_message);
   }
   if(_message){
     setTimeout(function(){
          show_notification(_message);
        },1000)
    }
}
saved_form_confirmation(); 

$(document).bind('gform_post_render', function(){
  
    if($('.validation_error').length){
        var _message = $('.validation_error').text();
        if(_message!=''){
            show_notification(_message); 
            $('.validation_error').text('');
        }
       // show_notification(_message);
    }
});


init_form_field_replace('login');
init_form_field_replace('reset-password-form');
init_form_field_replace('update-password-form');
init_form_field_replace('role-selection-form');

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