$(function(){
ajax_login = function(){
var dat = $('#notification #login').find(':input').serialize();
	console.log(MyAjax.ajaxurl);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
        if (data.success==1) {
        	//console.log(data);
       location.href=data.redirect;
        }
        }
} );


}
//
});