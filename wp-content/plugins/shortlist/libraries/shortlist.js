$(function(){


// shortlist button control
$('body').on('click','form.shortlist a.plus',function(e){
  e.preventDefault();
  _form = $(this).parent('form');
  ajax_shortlist_add(_form);
});
$('body').on('click','form.shortlist a.minus',function(e){
  e.preventDefault();
  _form = $(this).parent('form');
   show_notification('Are you sure you want to remove this candidate from your shortlist?',1,function(){
      ajax_shortlist_remove(_form);
   });

});


ajax_shortlist_add = function(_form){
var dat = $(_form).find(':input').serialize();
  if(console)  console.log(dat);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
        if(console) console.log(data);
      if(!data.error){
        $('.shortlist-link span.count').html(data.candidates);
        $('.icon-button',_form).removeClass('plus').addClass('minus').text('Remove Me');
         $('input[name=action]',_form).val('shortlist_remove_me');
         $('.icon-button.shortlist').show();
         $('.shortlist-link').show();
         show_notification('Candidate has been added to your shortlist');
        
      }
      
        }
});
}

ajax_shortlist_remove = function(_form){
var dat = $(_form).find(':input').serialize();
  if(console)  console.log(dat);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
      if(console) console.log(data);
      if(!data.error){
        $('.shortlist-link span.count').html(data.candidates);
         $('.icon-button',_form).removeClass('minus').addClass('plus').text('Shortlist Me');
         $('input[name=action]',_form).val('shortlist_add_me');
         if(data.total==0){
          $('.icon-button.shortlist').hide();
          $('.shortlist-link').hide();
         } else {
          $('.icon-button.shortlist').show();
          $('.shortlist-link').show();
         }
         //show_notification('Are you sure you want to remove this candidate from your shortlist?',1);

       }
      
       
        }
	});

}


});