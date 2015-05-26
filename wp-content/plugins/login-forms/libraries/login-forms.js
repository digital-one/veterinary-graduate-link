$(function(){
ajax_login = function(_form){
var dat = $(_form).find(':input').serialize();
console.log(dat);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
    	console.log(data);
    	
        if (!data.error){
        	if(data.redirect!=''){
        	//	console.log('redirect!');
        	location.href=data.redirect; //if no errors and redirect, then redirect to page
        	} else {
        		$('.validation_error',$(_form)).text(data.message); //if no errors, just show notification
        	}
     
        } else {
        	$('.validation_error',$(_form)).text(data.message);
        }
       
        }
} );


}
//
});