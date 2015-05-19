//------------------------------------
//
//	JQUERY.GFORM_VALIDATION.JS
//	Author: 	Digital One
//	Requires:	jquery 1.6
//	Version:	1
//		
//------------------------------------

(function($){
	
$.fn.gform_validation = function(options){
	
	var defaults = {
		'validation_error': 'There was a problem with your submission. Errors have been highlighted below.',
		'validation_message': 'This field is required.',
		'required_class': 'required',
		'email_field_id' : 'email'
		};
	
	var options = $.extend(defaults,options);

	return this.each(function(){
		
		var _this = $(this);
		var _errors = 0;
		var _required_fields = $('.'+options.required_class,_this);
		_this.wrap('<div class="gform_wrapper" />');
		$('input,textarea',_this).wrap('<div class="ginput_container" />');
		_this.on('submit',function(){
			_is_valid = validate_form();
			if(!_is_valid){
				return false;
			} else {
				$('input#submit').after('<img src="/wp-content/plugins/gravityforms/images/spinner.gif" class="gform_ajax_spinner" />');
			}
		})
		reset_form = function(){
			_required_fields.removeClass('gfield_error');
			_errors=0;
			$('.validation_error',_this).remove();
			$('.validation_message',_this).remove();
		}

		create_error = function(_elm){
			$(_elm).addClass('gfield_error');
			$(_elm).find('ginput_container').after('<div class="gfield_description validation_message">'+options.validation_message+'</div>');
			_errors++;
			//$(_field).parent().after('<div class="gfield_description validation_message">'+options.validation_message+'</div>');
		}
		
		validate_form = function(){
			reset_form();
				$.each( _required_fields, function( i, elm ) {
				_field = $('input,textarea',$(this));
				if(_field.attr('id')==options.email_field_id){
					//email validation
					var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  					if(!regex.test(_field.val())){
  						create_error($(this));
  					}
					

				} else {
					//input validation
					if(_field.val()==''){
						create_error($(this));
					}
				}
			});

				if(_errors){
					_this.prepend('<div class="validation_error">'+options.validation_error+'</div>');
					return false;
				} 
				return true;
		}

		function createInfo(title,content){
			return '<div class="infowindow" style="width:300px; height:auto;"><strong>'+ title +'</strong><br />'+content+'</div>';
		}

		function makeInfoWindowEvent(map, infowindow, marker) {  
		   return function() {  
		      infowindow.open(map, marker);
		   };  
		}

	//

})

	
}
})(jQuery);