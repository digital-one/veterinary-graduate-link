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


//candidate results pagination

var _loadElement =  '#posts',
    _resultsElement = '#search-results', //only need this as no results are initially shown on page
    _pagingElement = '#posts-footer',
    _btnElement = 'a.more-posts';


refresh_vars=  function(){
  _isMobile = $(window).width() < 768;
}

load_posts = function(){

if($(_loadElement).length){
var _windowMiddle = $(window).height()/2,
  _windowHeight = $(window).height(),
  _offset = $(_resultsElement).offset(),
  _postsHeight = $(_resultsElement).height(),
  _scrollTop = $(window).scrollTop(),
  _postsBottom = _offset.top + _postsHeight,
  _scrollAmount  = _postsBottom - _windowMiddle,
  _footerHeight = $(_pagingElement).outerHeight(),
  _lastScrollTop,
  _waypoint = (_postsHeight - _windowHeight) + 400;
if(_scrollTop > _waypoint && _scrollDirection=='down'){
  $(_btnElement).trigger('click');
}
if(_lastScrollTop < _scrollTop){
  _scrollDirection='down';
} else {
  _scrollDirection='up';
}
  _lastScrollTop = _scrollTop;
}
}

load_posts_click = function(e){

  e.preventDefault();
  var _this = e.currentTarget,
    _url = $(_this).attr('href');
   // _loadElement =  '#posts',
  //  _pagingElement = '#posts-footer',
  //  _btnElement = 'a.more-posts';

    if(!$(_btnElement).hasClass('end')){
  $(_this).data("label",$(_this).text());
  $(window).off('scroll',load_posts); //stop the scroll action
  $(_btnElement).off('click', load_posts_click); //stop the click action
  $(_this).addClass('loading');

  $.get(_url).done(function(data){
  $(_btnElement).on('click', load_posts_click);  
  $(window).on('scroll',load_posts);
  $(_btnElement).removeClass('loading');
  var _obj = $(data).find(_loadElement),
    _paging = $(data).find(_pagingElement),
    _btn = $(data).find(_btnElement);
    _items = _obj.children();
    $(_pagingElement).remove();
     $(_loadElement).append(_items);
    if(_paging!=null){
  $(_loadElement).after(_paging);
    }
  //$(_this).attr('href',_btn.attr('href')); //update the paging link
  //$(_this).attr('class',_btn.attr('class'));
 
  //_container.append(_items).masonry('appended',_items);
  });
  }
}

$('body').on('click','a.more-posts',load_posts_click);
$(window).on('scroll',load_posts);


//show candidate profile

$('.icon-button.profile').on('click',function(e){
    e.preventDefault();
  var _article = $(this).parents('article'),
      _profile = $('main.profile',_article),
      _this = $(this);
      if(_profile.hasClass('active')){
        _this.text('Show Profile');
        _profile.removeClass('active').slideUp(100);
      } else {
        _this.text('hide Profile');
        _profile.addClass('active').slideDown(100);
      }


})


/*
// shortlist button control
$('form.shortlist a.plus').on('click',function(e){
  e.preventDefault();
  _form = $(this).parent('form');
  ajax_shortlist_add(_form);
});
$('form.shortlist a.minus').on('click',function(e){
  e.preventDefault();
  _form = $(this).parent('form');
  ajax_shortlist_remove(_form);
});


ajax_shortlist_add = function(_form){
var dat = $(_form).find(':input').serialize();
console.log(dat);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
      console.log(data);
      
        
       
        }
});

}

ajax_shortlist_remove = function(_form){
var dat = $(_form).find(':input').serialize();
console.log(dat);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
      console.log(data);
      
       
        }
} );


}
*/

//add option groups to location dropdown field in forms


     //Use the class you used for the drop down here, I used ‘custom-opt’
     $('.locations select option').each(function() {
        //look for 'start', start a new optgroup with the label 
        if($(this).val()=='start') {
            var label = $(this).text();
            $(this).replaceWith("<optgroup label='"+label+"'>");
        }
 
        //look for 'end' end the optgroup here
        if($(this).val()=='end') {
            $(this).replaceWith('</optgroup>');
        }
    });



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

//make gravity forms place nice with foundation markup
$('.page-template-template-candidate-register .gform_body, .page-template-template-employer-register .gform_body, .page-template-template-employer-profile .gform_body, .page-template-template-candidate-profile .gform_body, .page-template-template-contact .gform_body').addClass('row');

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
    _elms  =$('#notification, #no-results, #role-selection, #login-form, #reset-password-request-form, #reset-password-form');
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
     show_overlay();
  
     $('#account-links').hide();
        if(_isMobile){
     $('.menu-toggle').hide();
     }
}
})
show_overlay = function(){
  $('body').prepend('<div id="overlay" />');
  $('#overlay').css({
    position:'fixed',
    left: '0',
    top: '0',
    display: 'block',
    width: '100%',
    height: '100%',
    'z-index': 9999,
    'background-color': 'transparent'
  })
}
hide_overlay = function(){
  $('#overlay').remove();
}
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
     if(_isMobile){
    $('.menu-toggle').show();
    }
    hide_overlay();
}
show_notification = function(_message,_confirm,_callback){
  show_overlay();
    _confirm = typeof _confirm !== 'undefined' ? _confirm : 0;
    _callback = typeof _callback !== 'undefined' ? _callback : 0;
    $('#notification .confirm').hide();
    $('#notification').addClass('active');

    $('#account-links').hide();
        $('#notification p').html(_message);
    $('.menu-toggle').hide();
    if(_confirm){
       $('#notification .confirm').show();
    } else {
      //  $('#notification .confirm').hide();
        setTimeout(function(){
          hide_notification();
        },4000)

    }
    if(_callback){
      $('#notification .confirm .yes').on('click',function(e){
        e.preventDefault();
        _callback();
        hide_notification();
      })
      $('#notification .confirm .no').on('click',function(e){
         e.preventDefault();
        hide_notification();
      })
    }
        $('#notification').slideDown(100);
}

$('.delete-user').on('click',function(e){
  e.preventDefault();
  show_notification('Are you sure you wish to delete your account?',true,function(){
    location.href=home_url+'/delete-user.php';
  })
})
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
   }
   if(get_url_parameter('saved')){
    _message = 'Thank you for registering. We have sent you an email to confirm your account.';
   }
   if(get_url_parameter('activate-success')){
    _message = 'Your account is now activated.';
   }
   if(get_url_parameter('activate-error')){
    _message = 'An error occurred during the activation of your account. Please register again.';
   }
   if(get_url_parameter('activate-nokey')){
    _message = 'An activation key is required. Please register again.';
   }
   if(get_url_parameter('account-deleted')){
    _message = 'Your account has been successfully deleted.';
   }
   if(get_url_parameter('shortlist-sent')){
    _message = 'Your shortlist has been successfully sent.';
   }
    if(get_url_parameter('login')){
      console.log('show login')
      $('a.login').trigger('click'); //if login param found, drop down login form
   }
   
   if(_message){
     setTimeout(function(){
          show_notification(_message);
        },500)
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
init_form_field_replace('search-form');

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