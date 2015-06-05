$(function(){


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
	});

}


});